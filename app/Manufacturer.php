<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = "manufacturers";
    protected $fillable = [
    	'name_ar',
    	'name_en',
        'email',
        'mobile',
        'address',
    	'facebook',
    	'twitter',
    	'website',
    	'contact_name',
    	//'lat',
    	// 'long',
        'icon',
    	'status',
    ];
}
