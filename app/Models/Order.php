<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{

use HasFactory;
    protected $guarded=['id'];
    function getStatusAttribute(){
        if(key_exists($this->status_id, status)){
            if(session('lang_id')==2){
              return en_status[$this->status_id];  
            }else{
              return status[$this->status_id];  
                
            }
        }
        return '';
    }
            function address(){
        return $this->belongsTo(Address::class,'address_id');
    }
    function details(){
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    
    

}
