<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $table = 'guest';
    protected $fillable = array('fullname','email','phone','country','cityname','postalcode','suburb','	address');
	public function orders(){
		return $this->morphMany('App\Models\Orders', 'orderable');
	}

	public function getaddress(){
		return $this->address.', '.$this->suburb.', '.$this->postalcode.' '.$this->cityname.', '.$this->country;
	}
}