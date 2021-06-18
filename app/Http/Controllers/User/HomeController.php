<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Manufacturer;

class HomeController extends Controller
{
    public function home(){
    	$latest_products = Product::latest('id')->where('status', 1)->where('product_status', 'active')->limit(6)->get();
    	$manufactures = Manufacturer::all()->where('status', 1);
    	return view('site.home', compact('latest_products', 'manufactures'));
    }
}
