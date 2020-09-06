<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";
    protected $fillable = [
    	'country_name_ar',
    	'country_name_en',
    	'country_code',
    	'country_iso_code',
        'country_currency',
    	'country_flag',
    	'status',
    ];

    /**
     * Get the cities for the country.
     */

    public function cities(){
    	return $this->hasMany('App\City');
    }


    /**
     * Get the states for the country.
     */

    public function states(){
        return $this->hasMany('App\State');
    }

    /**
     * Get the malls of the country   
    */

    public function malls(){
        return $this->hasMany('App\Mall', 'country_id', 'id');
    }
}
