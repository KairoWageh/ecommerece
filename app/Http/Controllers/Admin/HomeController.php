<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    public function home(){
    	$registeredUsers = User::count();
    	return view('admin.home', compact('registeredUsers'));
    }
}
