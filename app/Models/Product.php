<?php

namespace App\Models;

use App\Models\Language;

use App\Models\ProductImage;
use App\Models\TagsProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,Language;
    protected $guarded=['id'];
    public $timestamps=true;


    public function langs()
    {
        return $this->hasMany(ProductLang::class, 'product_id');
    }
 
    function getImagepathAttribute(){
        if($this->image)
            return url($this->image);
        return '';
    }

    function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    function options(){
        return $this->hasMany(ProductOption::class,'product_id');
    }
    function optionwithstock(){
    return $this->hasMany(ProductOption::class,'product_id')->where('stock','>',0);    
    }
    
    
    public function tags()
    {
        return $this->hasMany(TagsProducts::class, 'product_id');
    }
    
    

}
