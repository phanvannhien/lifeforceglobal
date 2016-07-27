<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    public $incrementing = false;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = array('id','user_id','total','status','address','updated_by');
    protected $guarded = array('id');
    public function details()
    {
        return $this->hasMany('App\Models\OrdersDetail','order_id','id');
    }

  
    public function orderable()
    {
      return $this->morphTo();
    }
 
}
