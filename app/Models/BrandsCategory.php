<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandsCategory extends Model {

    protected $table = 'brands_categories';
    public $timestamps=false;

    use HasFactory;
      

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
