<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'categories'; 

    public function product(){
    	return $this->hasmany('App\Models\Products','category_id','id');
    }
}
