<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\CartStorageModel;
use Auth;
use Cart;
use App\Order;
use App\OrderItem;
use App\Services\PayPalService;

class CartController extends Controller
{
    protected $payPal;
    public function __construct(PayPalService $payPal)
    {
        $this->payPal = $payPal;
    }

    public function getCart()
    {
        return view('site.cart');
    }

    public function addToCart($id)
	{
        // get the specific product
	    $product = Product::find($id);
        // get product id from the cart as the form userId_userName_cart_items
        $productFromCartId = Auth::user()->id .'_'. Auth::user()->name.'_cart_items';
        // search by id to get the user record in cart_storage table
        $productFromCart = CartStorageModel::find($productFromCartId);
        // search by cart_product_id as the form productId_productTitle
        $found = \Cart::get($product->id.'_'.$product->title);
        // test if product is added before to the cart
        // if added before increase the quantity by one
        if($found){
            \Cart::update($found->id, [
                'quantity' => +1,
                'attributes' => array(
                    'photo' => $product->photo,
                    'total_price' => $found->attributes->total_price + $found->price 
                )
            ]);    
        }else{
            // if not found create new record for product into user cart
            \Cart::add(array(
                'id'         => $product->id.'_'.$product->title, // id for each product in user cart
                'name'       => $product->title,
                'price'      => $product->price,
                'quantity'   => 1,
                'attributes' => array(
                    'photo' => $product->photo,
                    'total_price' => $product->price 
                )
            ));
        }
	    session()->flash('success', __('admin.record_added_successfully'));
        return redirect()->back();
	    // return redirect()->back()->with('message', 'Item added to cart successfully.');
	}

    public function checkOut(){
        return view('site.payment');
    }

    public function pay(Request $request) {
        $validatedData = $request->validate([
            'first_name'         => 'required',
            'last_name'          => 'required',
            'address'            => 'required',
            'city'               => 'required',
            'country'            => 'required',
            'post_code'          => 'sometimes|nullable|numeric',
            'phone_number'       => 'sometimes|nullable',
            'notes'              => 'sometimes|nullable'
        ], [], [
            'first_name'         => __('user.first_name'),
            'last_name'          => __('user.last_name'),
            'address'            => __('user.address'),
            'city'               => __('user.city'),
            'country'            => __('user.country'),
            'post_code'          => __('user.post_code'),
            'phone_number'       => __('user.phone_number'),
            'notes'              => __('user.notes')
        ]);
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  Cart::getSubTotal(),
            'item_count'        =>  Cart::getTotalQuantity(),
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'first_name'        =>  $request->first_name,
            'last_name'         =>  $request->last_name,
            'address'           =>  $request->address,
            'city'              =>  $request->city,
            'country'           =>  $request->country,
            'post_code'         =>  $request->post_code,
            'phone_number'      =>  $request->phone_number,
            'notes'             =>  $request->notes
        ]);

        if ($order) {
            $items = Cart::getContent();
            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('title', $item->name)->first();

                // if product not deleted by admin
                if($product){
                    $orderItem = new OrderItem([
                        'product_id'    =>  $product->id,
                        'quantity'      =>  $item->quantity,
                        'price'         =>  $item->getPriceSum()
                    ]);  
                    $order->items()->save($orderItem);  
                }   
            }
        }

        if ($order) {
            $this->payPal->processPayment($order);
        }

        return redirect()->back()->with('message','Order not placed');
        //return $request->input ( 'stripeToken' );
        // \Stripe\Stripe::setApiKey ( 'sk_test_51Gtx4zAvArrmnV6HEJJEJudAgY8FHgYz7S8VJv3nzOGKyP4Jk1wJLnzrOQQFbHkNdD2ckkIgaxBktY0kGICKEXY900o7lCgr9c' );
        // try {
        //     \Stripe\Charge::create ( array (
        //             "amount" => 300 * 100,
        //             "currency" => "usd",
        //             "source" => $_POST['stripeToken'], // obtained with Stripe.js
        //             "description" => "Test payment." 
        //     ) );
        //     session()->flash('success', __('Payment done successfully !'));
        //     return redirect('cart');
        // } catch ( \Exception $e ) {
        //     dd($e);
        //     session()->flash('error', __('Error! Please Try again.'));
        //     return redirect('cart');
        // }
    }

    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -'.$status['salesId'];
        $order->save();

        Cart::clear();
        return view('site.success', compact('order'));
    }

    public function removeFromCart($id)
    {
        Cart::remove($id);
        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return redirect()->back()->with('message', 'Item removed from cart successfully.');
    }

    public function clearCart()
    {
        Cart::clear();

        return redirect('/');
    }
    
}
