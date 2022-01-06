<?php

namespace App\Http\Controllers\apis;

use Elsayednofal\BackendLanguages\Models\Languages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Resources\CartsResource;
use Validator;

class CartsApi extends Controller {

    function add(Request $request) {
        $rules = ['product_id' => 'required|exists:products,id'];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        $product = Product::find($request->product_id);

        if ($product->stock < 1)
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['there is no stock for this product']]);
        $stock = $product->stock;
        if ($product->optionwithstock()->count()) {
            $rules = ['value_id' => 'required|exists:category_option_values,id'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
                return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        }
        if ($request->value_id != '') {
            $value = \App\Models\ProductOption::where('product_id', $request->product_id)->where('value_id', $request->value_id)->first();
            if(!is_object($value))
                                return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['Not Found']]);

            if ($value->stock < 1)
                return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['there is no stock for this product']]);

            $stock = $value->stock;
        }
        if (auth()->guard('api')->check()) {
            $session_id='';
            $cart = Cart::where('user_id', auth()->guard('api')->user()->id)->where('product_id', $request->product_id)->where('value_id', $request->value_id)->first();
            if (!is_object($cart)) {
                $cart = new Cart ();
                $cart->user_id = auth()->guard('api')->user()->id;
            }
        } elseif ($request->session_id != '') {
            $cart = Cart::where('session_id', $request->session_id)->where('product_id', $request->product_id)->where('value_id', $request->value_id)->first();
            $session_id = $request->session_id;
            if (!is_object($cart)) {
                $cart = new Cart ();
            }
                $cart->session_id = $request->session_id;
        } else {
            $cart = new Cart ();
            $session_id = md5($this->generateRandom(11));
            $cart->session_id = $session_id;
        }
        $number = 1;
        if ($request->number != '')
            $number = $request->number;
        if ($number <= $stock)
            $number = $number;
        else
            $number = $stock;
        $cart->product_id = $request->product_id;
        $cart->value_id = $request->value_id;
        $cart->number = $number;
        $cart->save();
        return response()->json(['status' => 200, 'data' => new CartsResource($cart), 'message' => 'success', 'session_id' => $session_id]);
    }

    function edit(Request $request) {
        $rules = ['cart_id' => 'required|exists:cart,id',
            'number' => 'required|min:1|integer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);

        $cart = Cart::find($request->cart_id);
        $product = Product::find($cart->product_id);
        $number = $request->number;
        $stock = $product->stock;
        if ($product->optionwithstock()->count()>0) {
            $value = \App\Models\ProductOption::where('product_id', $cart->product_id)->where('value_id', $cart->value_id)->first();
            $stock = $value->stock;
        }
        if ($number <= $stock)
            $number = $number;
        else
            $number = $stock;
        $cart->number = $number;
        $cart->save();
        return response()->json(['status' => 200, 'data' => new CartsResource($cart), 'message' => 'success']);
    }

    function index(Request $request) {
      $carts=[];
      if (auth()->guard('api')->check()) {
         
          $carts=Cart::where('user_id',auth()->guard('api')->user()->id)->get();
          $carts= CartsResource::collection($carts);
      }elseif ($request->session_id!='') {
            $carts= Cart::where('session_id',$request->session_id)->get();
          $carts= CartsResource::collection($carts);
                 

        }
        $total= $this->calculateTotal($carts);
        return response()->json(['status'=>200,'message'=>'success','data'=>$carts,'total'=>$total]);
    }

    function delete(Request $request) {
          $rules = ['cart_id' => 'required|exists:cart,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        Cart::where('id',$request->cart_id)->delete();
                return response()->json(['status' => 200,'message' => 'success']);

    }

    private function generateRandom($length = 11) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
    function calculateTotal($carts){
        $total=0;
        foreach ($carts as $cart){
            $total+=$cart->product->price_after_discount *$cart->number;
        }
        return $total;
    }
            function checkPromo(Request $request){
        $rules = ['promocode' => 'required|exists:promo_codes,code',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        $promocode= \App\Models\PromoCode::where('code',$request->promocode)->whereDate('expire', '>',\Carbon\Carbon::now())->first();
        if(!is_object($promocode))
                        return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => ['Promocode is not Found']]);
        return response()->json(['status'=>200,'message'=>'success','data'=>$promocode->toArray()]);
    }

    function assignToUser(Request $request){
        Cart::where('session_id',$request->session_id)->update(['user_id'=>$request->user()->id]);
    }
    
}
