<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table='addresses';
    protected $guarded=['id'];
    protected $casts=[
        'city_id'=>'string',
        'user_id'=>'string',
        ];
    protected $appends=['cityname','shipping'];
            function city(){
        return $this->belongsTo(City::class,'city_id');
        
    }
    function getCitynameAttribute(){
        $city= City::find($this->city_id);
      if(is_object($city))
          return $city->name;
      return '';
    }
    function getShippingAttribute(){
        
        return $this->city->shipping;
    }
}
