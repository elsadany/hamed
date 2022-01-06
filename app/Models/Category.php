<?php

namespace App\Models;

use App\Models\Language;
use App\Models\CategoryLang;
use App\Models\CategoryOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,Language;
    protected $guarded=['id'];

    
    public function langs()
    {
        return $this->hasMany(CategoryLang::class, 'category_id');
    }
    function getImagepathAttribute(){
        if($this->image)
            return url('uploads/'.$this->image);
        return '';
    }


    public function options()
    {
        return $this->hasMany(CategoryOption::class, 'category_id');
    }
    function main(){
        return $this->belongsTo(self::class,'parent_id');
    }
    function children(){
        return $this->hasMany(self::class,'parent_id');
    }
    
    

}
