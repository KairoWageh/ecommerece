<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities";
    protected $fillable = [
    	'city_name_ar',
    	'city_name_en',
    	'country_id',
    	'status',
    ];

    /**
    * The city belongs to on country
    */
    public function country(){
    	return $this->hasOne('App\Country', 'id', 'country_id');
    }

    /**
     * Get the states for the city.
     */

    public function states(){
        return $this->hasMany('App\State');
    }
}
