<?php

namespace App\Http\Controllers\backend;

use App\Models\Offer;
use App\Models\OfferBranches;
use App\Models\OfferMenues;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller {
  function __construct(){
        //dd($this->builtCategoryTree());
        view()->share('category_tree',$this->builtCategoryTree());
        view()->share('languages',Languages::all());
    }

    function builtCategoryTree($parent_id=0){
        $cats=Category::with('langs')->where('parent_id',$parent_id)->get()->toArray();
        foreach($cats as $i=>$cat){
            $cats[$i]['childs']=$this->builtCategoryTree($cat['id']);
        }
        return $cats;
    }
    function index(Request $request) {
$data['banners']= \App\Models\Banner::all();
      $data['home_page']=$hope_page= \App\Models\HomePage::all();
     $data['products']= \App\Models\Product::all();
     $data['languages']= Languages::all();
       $data['tags']= \App\Models\GeneralTag::all();
           
        return view('backend.home_page.index', $data);
    }
    function store(Request $request)
    {
        $rules=['products'=>'required|array',
            'products.*'=>'required|array',
            'products.*.*'=>'required',
            'category.*'=>'int'
            ];
        
        $request->validate($rules);
        foreach (\App\Models\GeneralTag::all() as $key=>$one)
        {
            $one->products()->delete();
            foreach ($request->products[$one->id] as $oneproduct){
                $tagproduct=new \App\Models\TagsProducts();
                $tagproduct->tag_id=$one->id;
                $tagproduct->product_id=$oneproduct;
                $tagproduct->save();
            }
        }
          
         
            \App\Models\Banner::orderBy('id','asc')->delete();
            if($request->has('category')){
            foreach ($request->category as $key=>$one){
                $banner=new \App\Models\Banner();
                $banner->category_id=$one;
                $banner->image=$request->get('image'.$key);
                $banner->save();
        }
        
            }
        
        return redirect()->back()->with('success','Updated Successfully');
    }
    
function anyUpload(Request $request) {

        $rules = ['file' => 'required|image'];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $data['status'] = 'error';
            $data['data'] = $validator->errors()->all();
        } else {
            $path = 'uploads';
            $thumb='uploads/thumbs';
            if (!file_exists($path)) {
                mkdir($path, 0775);
            }
            $datepath = date('m-Y', strtotime(\Carbon\Carbon::now()));
            if (!file_exists($path . '/' . $datepath)) {
                mkdir($path . '/' . $datepath, 0775);
            }
            $newdir = $path . '/' . $datepath;
           
        }
           
            $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
            $fileName = $this->generateRandom().(float) microtime() . '.' . $extension; // renameing image

            $request->file('file')->move($newdir, $fileName); // uploading file to given path
   
            $data['status'] = 'ok';
            $data['data'] = './' . $newdir . '/' . $fileName;
            $data['file'] = $newdir . '/' . $fileName;
        
        return json_encode($data);
    }
 function generateRandom($length = 11) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = time();
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
