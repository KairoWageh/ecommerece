<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
	// to be used in social login
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
