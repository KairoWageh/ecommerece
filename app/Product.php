<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
    	'title',
    	'photo',
    	'content',
    	'department_id',
    	'trade_id',
    	'manu_id',
    	'color_id',
    	'size_id',
    	'currency_id',
    	'price',
    	'stock',
    	'start_at',
    	'end_at',
    	'start_offer_at',
    	'end_offer_at',
    	'offer_price',
    	'other_data',
    	'weight',
    	'weight_id',
    	'product_status',
    	'reason',
    	'status',
    ];

    /**
     * relation between products and their department.
    */
    public function department(){
        return $this->hasOne('App\Department', 'id', 'department_id');
    }
    public function files(){
    	return $this->hasMany('App\File', 'relation_id', 'id')->where('file_type', 'product');
    }
}
