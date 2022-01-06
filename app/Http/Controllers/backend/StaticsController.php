<?php

namespace App\Http\Controllers\backend;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class StaticsController extends Controller {

    function index() {
       $data['users']= \App\Models\User::count();
       $data['cities']= \App\Models\City::count();
       $data['products']= \App\Models\Product::sum('stock');
       $data['finished_products']= \App\Models\Product::where('stock',0)->count();
       $data['new_orders']= \App\Models\Order::where('status_id',0)->count();
       $data['in_shipping']= \App\Models\Order::where('status_id',1)->count();
       $data['finished']= \App\Models\Order::where('status_id',2)->count();
       $data['selled']= \App\Models\OrderDetail::sum('number');
       $data['brands']= \App\Models\Brand::count();
        return view('backend.dashboard', $data);
    }

  

}
