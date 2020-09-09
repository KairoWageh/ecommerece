<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOtherData extends Model
{
    protected $table = "product_other_data";
    protected $fillable = [
    	'product_id',
    	'data_key',
    	'data_value',
    ];
}
