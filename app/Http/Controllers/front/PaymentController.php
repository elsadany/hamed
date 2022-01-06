<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller {

    function index(Request $request, $id) {
        $order = \App\Models\Order::where('id', $id)->first();
        $success_url = url('payment/success/'.$id.'?op=checkPayment');
        $cancel_url = url('payment/cancel?op=checkPayment');
        $code=$this->generatestring();
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://uatcheckout.thawani.om/api/v1/checkout/session",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => '{"client_reference_id": "'.$code.'","products": [{"name": "Order:' . $order->id . '","unit_amount": ' . ($order->price_after_discount * 1000) . ',"quantity": 1}],"total_amount":"' . $order->price_after_discount . '","success_url":"' . $success_url . '","cancel_url": "' . $cancel_url . '"'
            . ',"metadata"=["order_id":'.$order->id.',"customer_name":"'.$order->user->name.'","customer_phone":"'.$order->user->phone.'","customer_email":"'.$order->user->email.'"]}',
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "thawani-api-key: rRQ26GcsZzoEhbrP2HZvLYDbn9C9et"
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $session = json_decode($response)->data->session_id;
            $order->code=$code;
            $order->save();
            return redirect()->away("https://uatcheckout.thawani.om/pay/$session?key=HGvTMLDssJghr9tlN9gr4DVYt0qyBy");
        }
    }

    function success(Request $request,$id) {
        $order= \App\Models\Order::find($id);
        $order->is_paid=1;
        $order->save();
        $data['order']=$order;
        return view('front.thanx',$data);
    }
    function fail(Request $request) {
      
        return view('front.Fail');
    }
function generatestring($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
