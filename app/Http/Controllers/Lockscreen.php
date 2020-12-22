<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class Lockscreen extends Controller
{
    public function index(){
    	$username = Auth::user()->username;

    	Auth::logout();

		return view('Lockscreen.index', compact('username'));
    }
}
