<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $table = "malls";
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
        'country_id',
    	'status',
    ];

    public function country(){
        return $this->belongsTo('App\Country');
    }
}
