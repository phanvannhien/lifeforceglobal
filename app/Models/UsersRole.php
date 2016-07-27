<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersRole extends Model
{
    protected $table = 'users_role';
    
    // One Role has many users
    public function users(){
    	return $this->hasMany('App\User','user_role','role_id');
    }
}