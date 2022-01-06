<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Language;
use App\Models\CategoryLang;
use App\Models\CategoryOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory,Language;
    protected $guarded=['id'];
    public $timestamps=false;

    protected $appends=['imagePath'];

    public function langs()
    {
        return $this->hasMany(BrandLang::class, 'brand_id');
    }
    function categories(){
        return $this->hasMany(BrandsCategory::class,'brand_id');
    }

    function getImagepathAttribute(){
        if($this->image)
            return url('uploads/'.$this->image);
        return '';
    }
    
    
    function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
    
    

}
