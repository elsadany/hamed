<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model {

    protected $table = 'banners';

    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;
    protected $appends=['imagepath'];
 function getImagepathAttribute(){
        if($this->image)
            return url($this->image);
        return '';
    }
   
   

}
