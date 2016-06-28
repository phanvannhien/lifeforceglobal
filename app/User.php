<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


    protected $table = 'users';
    protected $guarded = array();

    const USER_DEFAULT_ROLE = "OM";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Orders','user_id','id');
    }

    public static function getMembersNumber(){
        $currentNumberUser = self::count();
        if( $currentNumberUser < 10 ){
            return '0000'.$currentNumberUser;
        }elseif ( $currentNumberUser < 100 ){
            return '000'.$currentNumberUser;
        }elseif ( $currentNumberUser < 1000 ){
            return '00'.$currentNumberUser;
        }elseif( $currentNumberUser < 10000 ){
            return '0'.$currentNumberUser;
        }
        return $currentNumberUser;
    }

    public static function getDefaultUserRole($userCity){
        return self::USER_DEFAULT_ROLE.'-'.self::getMembersNumber().'-00000-'.$userCity;
    }


}
