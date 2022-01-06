<?php

namespace App\Models;

use App\Models\ProductOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductOptionLang extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public $timestamps=false;

    
    public function option()
    {
        return $this->belongsTo(ProductOption::class, 'product_option_id');
    }
    
}
