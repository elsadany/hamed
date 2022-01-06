<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrandLang;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;
use App\Models\Category;
class BrandsController extends Controller {
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
    function index() {
        $data['result'] = Brand::all();
        return view('backend.brands.index', $data);
    }

    function create(Request $request) {
        $data['brand'] = $brand = new Brand();
        if ($request->isMethod('post'))
            $this->store($request, $brand);
        return view('backend.brands.create', $data);
    }

    function edit(Request $request, Brand $brand) {
          
        $data['brand'] = $brand ; 
         if ($request->isMethod('post'))
            $this->store($request, $brand);
        return view('backend.brands.update', $data);
    }

    function store($request, $object) {
        foreach (Languages::all() as $language) {
            $rules['name_' . $language->symbole] = 'required';
        }
         if (!($object->exists)) {
            $rules['image'] = 'required';
        }
        
        $request->validate($rules);
         if ($request->has('image')&&$request->image!='')
            $object->image = Media::moveTempImage($request->image);
        $object->save();
        
        foreach (Languages::all() as $lang) {
            $objectlang = BrandLang::where('brand_id', $object->id)->where('lang_id', $lang->id)->first();
            if (!is_object($objectlang))
                $objectlang = new BrandLang ();
            $objectlang->name = $request->get('name_' . $lang->symbole);
            $objectlang->lang_id = $lang->id;
            $objectlang->brand_id=$object->id;
            $objectlang->save();
            $object->categories()->delete();
            if($request->has('categories'))
            {
                foreach ($request->categories as $one){
                    $onebrand=new \App\Models\BrandsCategory();
                    $onebrand->brand_id=$object->id;
                    $onebrand->category_id=$one;
                    $onebrand->save();
                }
            }
        }
        
        return redirect()->back()->with('success', 'تم الحفظ بنجاح');
    }

    function delete(Request $request, Brand $brand) {
        $brand->delete();
        return response()->json(['status' => true, 'message' => 'تم الحذف  بنجاح']);
    }
    function getBrands($id){
        $ids= \App\Models\BrandsCategory::where('category_id',$id)->pluck('brand_id')->toArray();
        $brands= Brand::whereIn('id',$ids)->get();
        $text='';
        foreach ($brands as $brand){
            $text .="<option value='".$brand->id."'>".$brand->lang()->name."</option>";
        }
        return $text;
    }

}
