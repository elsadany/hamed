<?php

namespace App\Http\Controllers\apis;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\Cart;
class AuthApi extends Controller
{
    function login(Request $request){
        $validator= Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
          if($validator->fails())
                return response()->json(['status'=>500,'message'=>'Invalide Data','errors'=>$validator->errors()->all()]);
        $user = User::where('email', $request->email)->orWhere('phone',$request->email)->first();

        if (!is_object($user) || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 500, 'message' => 'incorrect email or password','errors'=>['incorrect email or password']]);
        }
        if($request->session_id!=''){
            Cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        }
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
             if($request->session_id!='')
            \App\Models\cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        $response['status'] = 200;
        $response['message'] = 'success';
        $response['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'remember'=>$request->remember_me?true:false,
            'user'=>$user->only(['id','email','name','phone','imagePath'])
        ];
        return response()->json($response);
    }
    function register(Request $request){
         $validator= Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
             'phone'=>'required|unique:users,phone',
             'name'=>'required',
             
            //'remember_me' => 'boolean'
        ]);
          if($validator->fails())
                return response()->json(['status'=>500,'message'=>'Invalide Data','errors'=>$validator->errors()->all()]);
         $user=new \App\Models\User;
         $user->email=$request->email;
         $user->name=$request->name;
         $user->password=Hash::make($request->password);
         $user->phone=$request->phone;
         $user->save();
          if($request->session_id!=''){
            Cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        }
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        if($request->session_id!='')
            \App\Models\cart::where('session_id',$request->session_id)->update(['user_id'=>$user->id]);
        $arr['status'] = 200;
        $arr['message'] = 'success';
        $arr['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
            )->toDateTimeString(),
            'userdata'=>$user->toArray()
        ];
        return response()->json($arr);
    }
       function loginSocial(Request $request) {
         $validator= Validator::make($request->all(), [
            'email' => 'required|string|email',
            'name' => 'required|string',
            
          
        ]);
 if($validator->fails())
                return response()->json(['status'=>500,'message'=>'Invalide Data','errors'=>$validator->errors()->all()]);
        $user = User::where('email', $request->email)->first();

        if(!is_object($user)){
        $data=$request->all();
  
          $user = User::create($data);
        }else{
           
            $user->phone=$request->phone;
            $user->name=$request->name;
            $user->save();
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
       
        $token->save();
        $arr['status'] = true;
        $arr['message'] = 'success';
        $arr['data'] = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
            )->toDateTimeString(),
            'userdata'=>$user->toArray()
        ];
        return response()->json($arr);
    }

}
