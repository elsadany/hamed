<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{

use HasFactory;
    protected $guarded=['id'];
    
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
   
    
    

}
