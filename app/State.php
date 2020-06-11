<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = "states";
    protected $fillable = [
    	'state_name_ar', 
    	'state_name_en', 
    	'city_id', 
    	'country_id',
    	'status'
    ];

    /**
	* state belongs to one city
    */

    public function city(){
    	return $this->hasOne('App\City', 'id', 'city_id');
    }
    /**
	* state belongs to one country
    */
    
    public function country(){
    	return $this->hasOne('App\Country', 'id', 'country_id');
    }
}
