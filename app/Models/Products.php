<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'product';

    public function category(){
    	return $this->belongsTo('App\Models\Categories','category_id');
    }
}
