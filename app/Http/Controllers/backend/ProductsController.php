<?php

namespace App\Http\Controllers\backend;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\GeneralTag;
use App\Models\ProductLang;
use App\Models\ProductImage;
use App\Models\TagsProducts;
use Illuminate\Http\Request;
use App\Models\ProductOption;
use App\Models\ProductOptionLang;
use App\Models\ProductOptionImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Elsayednofal\BackendLanguages\Models\Languages;
use App\Http\Controllers\backend\CategoriesController;

class ProductsController extends Controller
{

    function __construct(){
        view()->share('category_tree',(new CategoriesController)->builtCategoryTree());
    }

    function index(Request $request){
        $products=Product::orderBy('id','desc');
        if($request->has('ids'))
            $products=$products->whereIn('id','desc');
        if($request->product){
            $products=$this->search($request,$products);
        }
        $products=$products->paginate(25);
        return view('backend.products.index')->with('products',$products);
    }

    function search($request,$products){
        if($request->lang){
            $lang=new ProductLang;
            foreach ($request->lang as $key=>$value) {
                if($value=='')continue;
                $lang=$lang->where($key,'like',"%{$value}%");
            }
            $products_ids=$lang->pluck('product_id')->toArray();
            $products=$products->whereIn('id',$products_ids);
        }
        foreach ($request->product as $key=>$value) {
            if($value=='')continue;
            if(is_numeric($value)){
                $products=$products->where($key,$value);
            }else{
                $products=$products->where($key,'like',"%{$value}%");
            }
        }
        return $products;
    }

    function create(){
        return view('backend.products.create');
    }

    function edit(Product $product){
        return view('backend.products.update')->with('product_id',$product->id);
    }

    function getProduct(Product $product){
        return response()->json([
            'status'=>true,
            'data'=>[
                'product'=>$product,
                'langs'=>$product->langs,
                'images'=>$product->images,
                'tags'=>$product->tags()->pluck('tag_id')->toArray()
                ]
            ]);
    }

    function saveProduct(Request $request){
        $v=Validator::make($request->all(),[
            'product.category_id'=>'required|int',
            'product.brand_id'=>'required|int',
            'product.image'=>'required|string',
            'product.price'=>'required|min:1',
            'product.discount'=>'int|min:0',
            'product.stock'=>'int|min:1',
            'langs.*'=>'required',
            'langs.*.name'=>'required',
            'langs.*.description'=>'required'
        ]);
 if($v->fails())
                return response()->json(['status'=>FALSE,'message'=>'Invalide Data','errors'=>$v->errors()->all()]);
        $product=Product::findOrNew($request->product['id']);
        if($product->image && $request->product['image']!=$product->image){
            if(file_exists($product->image))
                unlink($product->image);
            //Storage::disk('public_uploads')->delete($product->image);
        }
        $product->fill($request->product);
        if(strstr($request->product['image'],'temp')){
            $new_path=str_replace('/temp/','/products/',$request->product['image']);
            if(!file_exists('uploads/products')){
                mkdir('uploads/products',0777);
            }
            rename($request->product['image'],$new_path);
            $product->image=$new_path;
        }
        $product->price_after_discount=$request->product['price']-$request->product['discount'];
        $product->save();

        foreach($request->langs as $lang){
            $product_lang=ProductLang::findOrNew($lang['id']);
            $product_lang->fill($lang);
            $product_lang->product_id=$product->id;
            $product_lang->save();
        }

        if($request->images && count($request->images)>0){
            $images_ids=collect($request->images)->pluck('id')->toArray();
            $images=ProductImage::where('product_id',$product->id)->whereNotIn('id',$images_ids)->pluck('image')->toArray();
            foreach($images as $img){
                if(file_exists($img))
                unlink($img);
            }
            //dd(11);   
            ProductImage::where('product_id',$product->id)->whereNotIn('id',$images_ids)->delete();
            
            foreach($request->images as $image){
                $product_image=ProductImage::findOrNew($image['id']);
                if($product_image->image==$image['image'])continue;
                $new_path=str_replace('/temp/','/products/',$image['image']);
                if(file_exists($image['image']))
                    rename($image['image'],$new_path);
                $product_image->image=$new_path;
                $product_image->product_id=$product->id;
                $product_image->save();
            }
        }

        if($request->tags && count($request->tags)>0){
            TagsProducts::where('product_id',$product->id)->delete();
            foreach($request->tags as $tag_id){
                $product->tags()->save(new TagsProducts(['tag_id'=>$tag_id]));
            }
        }
        $langs=ProductLang::where('product_id',$product->id)->get();
        $images=ProductImage::where('product_id',$product->id)->get();
        return response()->json(['status'=>true,'data'=>['product'=>$product,'langs'=>$langs,'images'=>$images]]);
        
    }

    function saveOPtion(Request $request){
        $request->validate([
            'option.option_id'=>'required|int'
        ]);

        $option=ProductOption::findOrNew($request->option['id']);
        $option->fill($request->option);
        $option->product_id=$request->product_id;
        $option->has_value=$request->option['value_id']!=''?false:true;
        $option->save();

        //dd($request->option['value_id'] , !$request->option['value_id'] , count($request->option['langs'])>0);
        if(!$request->option['value_id'] && count($request->option['langs'])>0){
            $langs=$request->option['langs'];
            foreach($langs as $lang){
                $product_lang=ProductOptionLang::findOrNew($lang['id']);
                $product_lang->product_option_id=$option->id;
                $product_lang->fill($lang);
                $product_lang->save();
            }
        }

        if(isset($request->option['images']) && count($request->option['images'])>0){
            $images_ids=collect($request->option['images'])->pluck('id')->toArray();
            $images=ProductOptionImage::where('product_id',$option->product_id)->where('option_id',$option->id)->whereNotIn('id',$images_ids)->pluck('image')->toArray();
            foreach($images as $img){
                if(file_exists($img))
                  unlink($img);
            }
            ProductOptionImage::where('product_id',$option->product_id)->where('option_id',$option->id)->whereNotIn('id',$images_ids)->delete();
            foreach($request->option['images'] as $image){
                $option_image=ProductOptionImage::findOrNew($image['id']);
                if($option_image->image==$image['image'])continue;
                $new_path=str_replace('/temp/','/products/',$image['image']);
                if(file_exists($image['image']))
                    rename($image['image'],$new_path);
                $option_image->image=$new_path;
                $option_image->product_id=$option->product_id;
                $option_image->option_id=$option->id;
                $option_image->save();
            }
        }


        $product_option=ProductOption::with('langs')->with('images')->find($option->id);
        return response()->json(['status'=>true,'data'=>$product_option]);
    }

    function getoptions(Product $product){
        $options=ProductOption::where('product_id',$product->id)->with('langs')->with('images')->get();
        return response()->json(['status'=>true,'data'=>$options]);
    }

    function deleteOption(Request $request){
        ProductOption::find($request->option_id)->delete();
        return response()->json(['status'=>true,'message'=>'تم الحذف بنجاح ']);
    }

    function deleteProduct(Request $request){}

    function getLanguages(){
        $langs=Languages::all();
        return response()->json(['status'=>true,'data'=>$langs]);
    }

    function getCategories(){
        $cats=(new CategoriesController)->builtCategoryTree();
        return response()->json(['status'=>true,'data'=>$cats]);
    }

    function getBrands(){
        $brands=Brand::with('langs')->get();
        return response()->json(['status'=>true,'data'=>$brands]);
    }

    function getCategoryOptions(Category $category){
        $options= \App\Models\CategoryOption::with('values')->with('langs')->get();
        //dd($options->toArray());
        foreach($options as $key=>$option){
            foreach($option->values as $index=>$value){
                $options[$key]->values[$index]->langs=$value->langs;
            }
        }
        //dd($options->toArray());
        return response()->json(['status'=>true,'data'=>$options]);
    }

    function uploadImages(Request $request){
        $request->validate([
            'images.*'=>'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);
        
        foreach($request->images as $image){
            $file_name=md5(microtime()).'.'.$image->getClientOriginalExtension();
            $path = $image->storeAs(
                'temp',$file_name,'public_uploads'
            );
            $result[]='uploads/temp/'.$file_name;
        }
                
        return response()->json(['status'=>true,'data'=>$result]);
    }

    function delete(Product $product){
        $product->delete();
        return response()->json(['status'=>true,'message'=>'تم الحذف بنجاح']);
    }

    function getTags(){
        $tags=GeneralTag::with('langs')->get();
        return response()->json($tags);
    }

}