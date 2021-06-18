<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartStorageModel extends Model
{
    protected $table = "cart_storage";
    protected $fillable = [
    	'id',
    	'cart_data',
        'user_id'
    ];

    public function setCartDataAttribute($value){
    	$this->attributes['cart_data'] = serialize($value);
    }

    public function getCartDataAttribute($value){
    	return unserialize($value);
    }
}
