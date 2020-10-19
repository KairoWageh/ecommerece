<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Product;
use App\Department;

class ProductsController extends Controller
{
 //    public function addToCart(Request $request)
	// {
	//     $product = $this->productRepository->findProductById($request->input('productId'));
	//     $options = $request->except('_token', 'productId', 'price', 'qty');

	//     // $id, $name = null, $price = null, $quantity = null, $attributes = array(), $conditions = array(), $associatedModel = null
	//     Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

	//     return redirect()->back()->with('message', 'Item added to cart successfully.');
	// }

	public function single_product($id){
		$product = Product::find($id);
		$department_id = $product->department_id;
		$department = Department::find($department_id);

		return view('site.single_product', compact('product', 'department'));
	}
}
