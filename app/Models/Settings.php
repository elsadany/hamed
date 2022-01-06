<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'key'=>'required|size:255',
        'value'=>'required',
        'type'=>'required|integer',
    ];
}