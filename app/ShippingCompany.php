<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    protected $table = "shipping_companies";
    protected $fillable = [
    	'name_ar',
    	'name_en',
    	'user_id',
    	//'lat',
    	// 'long',
        'icon',
    	'status',
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
