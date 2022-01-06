<?php

namespace App\Http\Controllers\apis;

use Elsayednofal\BackendLanguages\Models\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomepageResourse;
use Validator;
use App\Http\Resources\OrdersResource;
use App\Models\Address;
use App\Http\Resources\CartsResource;
class OrdersApi extends Controller {

    function cost(Request $request) {
        $rules = ['address_id' => 'required|exists:addresses,id',
            'promo_id' => 'exists:promo_codes,id',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        $carts = \App\Models\Cart::where('user_id', auth()->guard('api')->user()->id)->get();
        if (count($carts) < 1)
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['Cart Has no Products']]);
        if ($request->promo_id != '') {
            $promo = \App\Models\PromoCode::where('id', $request->promo_id)->whereDate('expire', '>', \Carbon\Carbon::now())->first();
            if (!is_object($promo))
                return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['Promo not exist']]);
        }
        $data['total']=$total = $this->calculateTotal($carts);
        $data['discount']=$discount = 0;
        if ($request->promo_id != '') {
           $data['discount']= $discount = $total * $promo->discount_precent / 100;
            
        }
        $data['price_after_discount']=$price_after_discount=$total-$discount;
         $data['shipping']=$shipping=Address::find($request->address_id)->shipping;
         $data['price_after_shipping']=$after_shipping=$price_after_discount+$shipping;
        return response()->json(['status'=>200,'data'=>CartsResource::collection($carts),
          'total'=>$total,'discount'=>$discount,'price_after_discount'=>$price_after_discount,'shipping'=>$shipping,'price_after_shipping'=>$after_shipping,'prices'=>$data]);
    }

    function index(Request $request) {
        $rules = [
            'address_id' => 'required|exists:addresses,id',
            'promo_id' => 'exists:promo_codes,id',
        ];
       

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        $carts = \App\Models\Cart::where('user_id', auth()->guard('api')->user()->id)->get();
        if (count($carts) < 1)
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['Cart Has no Products']]);
        if ($request->promo_id != '') {
            $promo = \App\Models\PromoCode::where('id', $request->promo_id)->whereDate('expire', '>', \Carbon\Carbon::now())->first();
            if (!is_object($promo))
                return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['Promo not exist']]);
        }
        $order = new \App\Models\Order();
        $order->user_id = auth()->guard('api')->user()->id;
        $order->address_id = $request->address_id;
        $order->pay_method = $request->pay_method;
        $order->total = $this->calculateTotal($carts);
        $discount = 0;
        if ($request->promo_id != '') {
            $discount = $order->total * $promo->discount_precent / 100;
            $order->promo_id = $promo->id;
        }
        $order->discount = $discount;
        $shipping=Address::find($request->address_id)->shipping;
        $order->price_after_discount = $order->total - $order->discount+$shipping;
        $order->shipping=$shipping;
        $order->save();
        $this->saveDetails($carts, $order->id);
        return response()->json(['status' => 200, 'message' => 'success', 'data' => new OrdersResource($order)]);
    }

    function calculateTotal($carts) {
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->price_after_discount * $cart->number;
        }
        return $total;
    }

    function saveDetails($carts, $order_id) {
        foreach ($carts as $cart) {
            $detail = new \App\Models\OrderDetail;
            $detail->product_id = $cart->product_id;
            $detail->number = $cart->number;
            $detail->value_id = $cart->value_id;
            $detail->price = $cart->product->price_after_discount;
            $detail->total = $cart->product->price_after_discount * $cart->number;
            $detail->order_id = $order_id;
            $detail->save();
            $cart->delete();
        }
    }

}
