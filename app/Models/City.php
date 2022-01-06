<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    use Language;
    public $timestamps=false;
    protected $appends = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    function langs() {
        return $this->hasMany(CityLang::class, 'city_id');
    }

    function getNameAttribute() {
        if (session('lang_id') != null)
            return $this->lang(session('lang_id'))->name;
        return $this->lang()->name;
    }

}
