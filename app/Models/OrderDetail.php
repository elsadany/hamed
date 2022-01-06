<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    protected $table='order_details';

use HasFactory;
    protected $guarded=['id'];
    function value(){
        return $this->belongsTo(CategoryOptionValue::class,'value_id');
    }
    function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
   
    
    

}
