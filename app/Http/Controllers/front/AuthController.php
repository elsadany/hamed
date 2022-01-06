<?php

namespace App\Http\Controllers\front;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use ElsayedNofal\Helpers\controllers\Mail;

class AuthController extends Controller {

    function login(Request $request) {
        if (auth()->check())
            return redirect('/');
        return view('front.auth.login');
    }

    function postLogin(Request $request) {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->orWhere('phone', $request->email)->first();

        if (!is_object($user) || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['incorrect  password']);
        }
        auth()->login($user,1);
        if (session()->get('session_id')) {
            Cart::where('session_id', session()->get('session_id'))->update(['user_id' => $user->id]);
            return redirect('cart');
        }
        return redirect('/');
    }

    function checklogin(Request $request){
        if(!auth()->check())
            return response()->json(['status'=>500]);
        $user=$request->user();
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

    function register(Request $request) {
        return view('front.auth.register');
    }

    function postRegister(Request $request) {
        if (auth()->check())
            return redirect('/');
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();
        auth()->login($user);
        return redirect('/');
    }

    function forgetPassword(Request $request) {
         if ($request->has('email')) {
            $request->validate(['email' => 'required|email|exists:users,email']);
            $user = User::where('email', $request->email)->first();
            $user->reset_password_token = time() . $this->generatestring(6);
            $user->save();
            if ($request->server('REMOTE_ADDR') != '::1')
                $this->sendResetMail($user);
         }
         return view('front.auth.forget');
    }

    function resetPassword(Request $request,$name) {
       $data['user'] = $user = User::where('reset_password_token', $name)->firstOrFail();
        if ($request->has('password')) {
            $request->validate(['password' => 'required',
                'confirm-password' => 'required|same:password'
        ]);
          //dd($request->all());
     \DB::table('users')->where('reset_password_token', $name)->update(['password'=>Hash::make($request->password),'reset_password_token'=>'']);
            return redirect('login')->with('success', trans('auth.reset_successfully'));
        }
        return view('front.auth.reset', $data);
    }
  private function sendResetMail(User $user) {
        $from = config('backend-users.mail_from');
        $subject = 'Confirm Your email| LivewellGx';
        $message = view('front.auth.reset-mail')->with('user', $user)->render();
        Mail::send($from, $user->email, $subject, $message);
    }
    function generatestring($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function logout(Request $request){
        auth()->logout();
        return redirect('/');
    }
}
