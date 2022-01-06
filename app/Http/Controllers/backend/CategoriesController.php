<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use App\Models\CategoryLang;
use Illuminate\Http\Request;
use App\Models\CategoryOption;
use App\Models\OptionValueLang;
use App\Models\CategoryOptionLang;
use App\Models\CategoryOptionValue;
use App\Http\Controllers\Controller;
use Elsayednofal\BackendLanguages\Models\Languages;
use Elsayednofal\Imagemanager\Controllers\MediaController as Media;

class CategoriesController extends Controller
{

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

    function index(Request $request){
        $categories=Category::orderBy('id','desc')->get();
        $data['categories']=$categories;
        return view('backend.categories.index',$data);
    }

    function create(Request $request){
        $category=new Category;
        if($request->isMethod('POST'))
            return $this->store($request,$category);
        return view('backend.categories.create')->with('category',$category);
    }

    function edit(Request $request,Category $category){
        if($request->isMethod('POST'))
            return $this->store($request,$category);
        return view('backend.categories.edit')->with('category',$category);
    }

    function delete(Request $request,Category $category){
        $category->delete();
        return response()->json(['status'=>true,'message'=>'تم الحذف بنجاح']);
    }

    function store(Request $request,Category $category){
       $rules=[];
       
            $rules['lang.*'] = 'required';
           
        
           if (!($category->exists)) {
            $rules['image'] = 'required';
        }
        $request->validate($rules);
        \DB::beginTransaction();
        try {
            // save category
            $category->fill($request->category);
            if($request->image!='')
                $category->image=Media::moveTempImage($request->image);
            $category->save();

            // delete and save new langs
            $category->langs()->delete();
            foreach($request->lang as $lang_id=>$lang_data){
                $lang_data['lang_id']=$lang_id;
                $category->langs()->save(new CategoryLang($lang_data));
            }


            \DB::commit();
            if($request->save_option)
                return redirect('./backend/options/'.$category->id);
            return redirect()->back()->with(['success'=>'تم الاضافة بنجاح']);
            // save options
            foreach($request->option['type'] as $key=>$type){
                if(isset($request->option['id'][$key])){
                    $option=CategoryOption::find($request->option['id'][$key]);
                }else{
                    $option=new CategoryOption;
                }
                $option->category_id=$category->id;
                $option->type=$type;
                $option->affect_price=$request->affect_price[$key]?true:false;
                $option->in_filter=$request->in_filter[$key]?true:false;
                $option->is_required=$request->is_required[$key]?true:false;
                $option->save();
                $option_ids[]=$option->id;

                // update option langs
                foreach(Languages::all() as $langugae){
                    foreach($request->option[$language->id]['name'] as $key=>$value){
                        $option_lang=CategoryOptionLang::findOrNew(['option_id'=>$option->id,'lang_id'=>$language->id]);
                        $option_lang->option_id=$option->id;
                        $option_lang->lang_id=$language->id;
                        $option_lang->name=$name;
                        $option_lang->save();
                    }
                }

                // option values here 
                if(in_array($option->type,[2,5])){
                    if($request->option['value']['id'][$key]){
                        $option_value=CategoryOptionValue::find($request->option['value']['id'][$key]);
                    }else{
                        $option_value=new CategoryOptionValue;
                    }
                    $option_value->option_id=$option->id;
                    $option_value->save();
                    
                }

                

            }            
            // delete unused option 
            CategoryOption::where('category_id',$category->id)->whereNotIn($option_ids)->delete();
            
            
        } catch (\Exception $ex) {
            \DB::rollback();
            throw $ex;
        }
    }
}