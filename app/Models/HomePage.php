<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomePage extends Model {

    protected $table = 'home_page';

    use HasFactory,
        Language;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function langs() {
        return $this->hasMany(HomePageLang::class, 'home_page_id');
    }
    function products(){
        return $this->hasMany(HomePageProduct::class,'home_page_id');
    }

}
