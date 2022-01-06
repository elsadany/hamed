<?php
namespace App\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CategoryController extends Controller {
    function index(Request $request,$id=null){
        $data['category']= \App\Models\Category::find($id);
        $data['id']=$id;
        return view('front.pages.category',$data);
    }
    function products(Request $request,$id=null){
        $data['tag_id']=$id;
        return view('front.pages.products',$data);
    }

    function search(Request $request,$name=null){
      if($request->has('search')!=''){
          return redirect('search/'.$request->search);
      }
        $data['search']=$name;
        return view('front.pages.search',$data);
    }
}

