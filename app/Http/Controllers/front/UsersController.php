<?php
namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use ElsayedNofal\Helpers\controllers\Mail;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;
class UsersController extends Controller {
    function myaccount(Request $request){
        $data['addresses']= \App\Models\Address::where('user_id', auth()->user()->id)->get();
        $data['cities']= \App\Models\City::all();
        $data['orders']= \App\Models\Order::OrderBy('id','desc')->where('user_id',auth()->user()->id)->get();
        return view('front.users.myaccount',$data);
    }
    function updateProfile(Request $request){
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',];
        if ($request->user()->email != $request->email)
            $rules['email'] = 'required|email|unique:users,email';
        if ($request->user()->phone != $request->phone)
            $rules['phone'] = 'required|unique:users,phone';
        $request->validate($rules);
        $user=auth()->user();
         if ($request->has('image')&&$request->image!='')
            $user->image = Media::moveTempImage($request->image);
         $user->name=$request->name;
         $user->email=$request->email;
         $user->phone=$request->phone;
        if($request->password!='')
            $user->password=$request->password;
        $user->save();
        return redirect()->back()->withSuccess(trans('auth.updated_successfully'));
    }
    function saveAddress(Request $request){
         $rules = [
            'address_id' => 'required|exists:addresses,id',
            'city_id' => 'required|exists:cities,id',
              'district' => 'required',
                    'address' => 'required'];
         session()->flash('tab','true');
          $request->validate($rules);
          $address=\App\Models\Address::find($request->address_id);
          $address->city_id=$request->city_id;
          $address->district=$request->district;
          $address->address=$request->address;
          $address->notes=$request->notes;
          $address->save();
          return redirect()->back()->withSuccess(trans('auth.updated_successfully'));
    }
    function myOrder(Request $request,$id){
        $data['order']= \App\Models\Order::find($id);
        return view('front.users.order-detials',$data);
    }
}

