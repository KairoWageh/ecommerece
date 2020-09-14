<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    public function home(){
    	$latest_products = Product::latest('id')->where('status', 1)->where('product_status', 'active')->limit(6)->get();
    	// if(count($latest_products) == 0){
    	// 	$latest_products = 
    	// }
    	return view('site.home', compact('latest_products'));
    }
}
