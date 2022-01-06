<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model {

    use Language;

    public $timestamps = false;

    function langs() {
        return $this->hasMany(StaticPageLang::class, 'static_page_id');
    }

   

}
