<?php

namespace App\Models;

use App\Models\Language;
use App\Models\ProductOptionLang;
use App\Models\ProductOptionImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductOption extends Model
{
    use HasFactory,Language;
    protected $guarded=['id'];
    public $timestamps=false;
    protected $casts=[
        'has_value'=>'boolean'
    ];

    
    function langs(){
        return $this->hasMany(ProductOptionLang::class, 'product_option_id');
    }
    function option(){
        return $this->belongsTo(CategoryOption::class,'option_id');
    }
    function value(){
        return $this->belongsTo(CategoryOptionValue::class,'value_id');
    }

    
    function images(){
        return $this->hasMany(ProductOptionImage::class, 'option_id');
    }
    
    function getImageArrAttribute(){
        $images= ProductOptionImage::where('option_id', $this->id)->pluck('image');
        $arr=[];
        foreach ($images as $k=>$one){
            $arr[$k]=url($one);
        }
        return $arr;
    }
    
    
    
}
