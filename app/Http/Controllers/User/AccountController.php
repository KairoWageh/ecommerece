<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
	public function index(){
		$user = auth()->user();
		return view('site.my_account', compact('user'));
	}

    public function getOrders()
    {
        $orders = auth()->user()->orders;

        return view('site.orders', compact('orders'));
    }
}
