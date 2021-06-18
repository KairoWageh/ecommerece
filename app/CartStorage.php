<?php

namespace App;

use Darryldecode\Cart\CartCollection;
use Auth;

class CartStorage
{
    public function has($key){
        return CartStorageModel::find($key);
    }

    public function get($key){
        if($this->has($key)){
            return new CartCollection(CartStorageModel::find($key)->cart_data);
        }else{
            return [];
        }
    }

    public function put($key, $value){

        if($row = CartStorageModel::find($key)){
            $row->cart_data = $value;
            $row->save();
        }else{
            CartStorageModel::create([
                'id'        => $key,
                'cart_data' => $value,
                'user_id'   => Auth::user()->id
            ]);
        }
    }
}