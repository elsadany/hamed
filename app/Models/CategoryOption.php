<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Language;
use App\Models\CategoryOptionLang;
use App\Models\CategoryOptionValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryOption extends Model
{
    use HasFactory,Language;
    protected $guarded=['id'];

    protected $casts=[
        'type'=>'integer',
        'affect_price'=>'integer',
        ];
    public function langs()
    {
        return $this->hasMany(CategoryOptionLang::class, 'option_id');
    }

    
    public function values()
    {
        return $this->hasMany(CategoryOptionValue::class, 'option_id');
    }

    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    function getTypenameAttribute(){
        if(key_exists($this->type, types))
                return types[$this->type];
        return '';
    }
    
    
}
