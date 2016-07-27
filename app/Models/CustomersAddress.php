<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomersAddress extends Model
{
    //
     protected $table = 'customers_address';
     public function getaddress(){
     	return $this->address.', '.$this->suburb.', '.$this->postalcode.' '.$this->cityname.', '.$this->country;
     }
}
