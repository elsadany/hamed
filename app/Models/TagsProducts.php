<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagsProducts extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $table='tags_products';
   
    
}
