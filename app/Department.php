<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";
    protected $fillable = [
    	'department_name_ar', 
    	'department_name_en', 
    	'icon', 
    	'department_description_ar',
        'department_description_en',
    	'keywords',
    	'parent_id',
        'status',
    ];

    /**
     * relation between a department and its children departments.
    */
    public function parents(){
    	return $this->hasMany('App\Department', 'id', 'parent_id');
    }

    /**
     * relation between a department and its products.
    */
    public function products(){
        return $this->hasMany('App\Product');
    }

    /**
    * 
    */

    public function sizes(){
        return $this->hasMany('App\Size');
    }
}
