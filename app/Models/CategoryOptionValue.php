<?php

namespace App\Models;

use App\Models\Language;
use App\Models\OptionValueLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryOptionValue extends Model
{
    use HasFactory,Language;
    protected $guarded=['id'];

    
    public function langs()
    {
        return $this->hasMany(OptionValueLang::class, 'value_id');
    }
    
}
