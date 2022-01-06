<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    function index(Request $request){
        $data['users']= User::paginate(20);
        return view('backend.users.index',$data);
    }
    
}

