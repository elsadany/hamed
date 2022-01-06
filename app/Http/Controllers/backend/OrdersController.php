<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    function index(Request $request){
        $data['orders']= Order::orderBy('id','desc')->paginate(20);
        return view('backend.orders.index',$data);
    }
     function updateStatus(Request $request, $id) {
        $order= Order::findOrFail($id);
        if($request->status_id!=''){
            $order->status_id=$request->status_id;
            $order->save();
            session()->flash('success','updated Successfully');
            return redirect()->back();
        }
    }
    
}

