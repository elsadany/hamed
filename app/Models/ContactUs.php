<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
	protected $guarded = ['id'];
	
	
    //=========Rules===============
    public $rules=[
        'name'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        'message'=>'required',
    ];
}