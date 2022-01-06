<?php
namespace App\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class HomeController extends Controller {
    function index(Request $request){
     
     $contact=new \App\Models\ContactUs();
     $contact->name=$request->name;
     $contact->email=$request->email;
     $contact->subject=$request->subject;
     $contact->message=$request->message;
     $contact->save();
     return redirect()->back()->withSuccess('Your Message sent Successfully ');
        
    }
    function subscribe(Request $request){
        $subscriber= \App\Models\Subscriber::where('email',$request->email)->first();
        if(!is_object($subscriber))
            $subscriber=new \App\Models\Subscriber();
        $subscriber->email=$request->email;
        $subscriber->save();
        session()->put('subscribe_success','true');
        return redirect()->back()->withSuccess('Subscribed Successfully');
    }
}
