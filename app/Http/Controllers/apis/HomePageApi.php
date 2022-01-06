<?php

namespace App\Http\Controllers\apis;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Resources\HomepageResourse;
use Elsayednofal\BackendLanguages\Models\Languages;
use App\Models\Settings;
use App\Models\ContactUs;
use App\Http\Resources\GeneralTagsResourse;
class HomePageApi extends Controller {

    function index(Request $request){
        $banners= \App\Models\Banner::all();
        
   $tags= \App\Models\GeneralTag::all();
 
        $brands=Brand::has('products')->inRandomOrder()->limit(4)->get();
        return response()->json([
            'status'=>200,
            'data'=>GeneralTagsResourse::collection($tags),'banners'=>$banners,'brands'=>$brands
            ]);
    }
    function tags(Request $request){
        $tags= \App\Models\GeneralTag::all();
        return response()->json(['status'=>200,'data'=>$tags->toArray()]);
    }
    function setting(){
        $setting= Settings::all();
        $arr=[];
        foreach ($setting as $one)
        {
            $arr[$one->key]=$one->value;
        }
        
         return response()->json(['status'=>200,'data'=>$arr]);
    }
    function about(Request $request){
       $staticpage= \App\Models\StaticPage::where('slug','about_us')->first();
        $data=["title" =>$staticpage->lang(session('lang_id'))->title,
            'content'=>$staticpage->lang(session('lang_id'))->description
        ];
         return response()->json(['status'=>200,'data'=>$data]);
    }
            function upload(){
        foreach (\App\Models\Product::all() as $one){
            foreach (\App\Models\GeneralTag::all() as $row){
                $tagpr=new \App\Models\TagsProducts();
                $tagpr->tag_id=$row->id;
                $tagpr->product_id=$one->id;
                $tagpr->save();
            }
        }
    }
    function contact(Request $request){
        $validator = \Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'subject' => 'required',
                    'message' => 'required',
        ]);
        if ($validator->fails())
            return response()->json(['status' => 500, 'message' => 'Invalide Data', 'errors' => $validator->errors()->all()]);
        $contact=new ContactUs();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->subject=$request->subject;
        $contact->message=$request->message;
        $contact->save();
         return response()->json(['status'=>200,'message'=>'success']);
    }
}
