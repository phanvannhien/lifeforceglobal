<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model
{
    //
     protected $table = 'orders_detail';

     public function order(){
          return $this->belongsTo('App\Model\Orders','order_id');
     }

     public function getProduct()
     {
          return $this->hasOne('App\Models\Products','id','product_id');
     }
}
