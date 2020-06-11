<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = "sizes";
    protected $fillable = [
    	'name_ar', 
    	'name_en', 
    	'department_id', 
    	'is_public',
    	'status'
    ];

    public function department(){
    	return $this->belongsTo('App\Department');
    }
}
