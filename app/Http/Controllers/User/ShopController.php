<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ShopController extends Controller
{
    public function index(){
    	$products = Product::all()->where('status', 1)->where('product_status', 'active');
    	return view('site.shop', compact('products'));
    }
}
