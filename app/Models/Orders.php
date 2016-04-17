<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';

    public function details()
    {
        return $this->hasMany('App\Models\OrdersDetail','order_id','id');
    }

     public function getAddress()
    {
        return $this->hasOne('App\Models\CustomersAddress','id','address_id');
    }
}
