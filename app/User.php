<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
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
        return $this->morphMany('App\Models\Orders', 'orderable');
    }

    // One User has One Role
    public function role(){
        return $this->belongsTo('App\Models\UsersRole','user_role','role_id');
    }

    public static function getMembersNumber(){
        $currentNumberUser = self::count() + 1;
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

    public static function getUserCode( $userCode, $userCity ){
        $uplineCode = '00000';
        if ($userCode != ''){
            $uplineCode = substr($userCode,3,5);
        }
        return self::USER_DEFAULT_ROLE.'-'.self::getMembersNumber().'-'.$uplineCode.'-'.$userCity;
    }





    public static function getCommissionMembers($members, $membersFind){
    
        $commission = 0;
        foreach ($members as $member) {
            if( $membersFind->user_code == $member->user_refferal ){
                switch ($member->user_level) {
                    case 1:
                        # code...
                        $commission += $member->totals * 0.05;
                        break;
                    case 2:
                        # code...
                        $commission += $member->totals * 0.05;
                        break;    
                    case 3:
                        # code...
                        $commission += $member->totals * 0.1;
                        break;

                    default:
                        # code...
                        $commission = 0;
                        break;
                }
            }
            # code...
        }
        return $commission;

    }

    public static function getUplineMembers( $rows, $userCode , &$result = array() ){
        if($rows)
            foreach ($rows as $key => $row) {
                # code...
                if( $row->user_refferal == $userCode ){
                    $row->commission = 0;
                    $arrUpline = explode(',',$row->uplinepath);
                    if( count($arrUpline) > 0 ){
                        //each upline
                        foreach ($result as $perMembers){
                            if( in_array( $perMembers->id , $arrUpline) ){
                                if( ((int)$row->user_level - 1) == (int)$perMembers->user_level ){
                                    $perMembers->commission +=  (float)$row->totals * 0.1;
                                }else{
                                    $perMembers->commission +=  (float)$row->totals * 0.05;
                                }
                            }

                        }
                    }

                    $row->parent_class = 'treegrid-parent-'.$userCode;
                    $row->class = 'treegrid-'.$row->user_code;
                    array_push($result, $row);
                    unset($rows[$key]);
                    self::getUplineMembers($rows, $row->user_code, $result );
                }
            }
        return $result;
    }

    public static function getTotalPurchaseMembers($users,$whereOrder = '',$whereUser = ''){

        $userID = '';
        foreach ($users as $user) {
            # code...
            $userID .= $user->id.',';
        }

        $userID = substr($userID,0,-1);
        $initWhereUser = "u.user_status = 1 AND u.id IN ({$userID})";
        $initWhereOrder = "orders.status = 'done' AND orders.checkout_type = 'member' ";
        if ($whereUser != ''){
            $initWhereUser = $initWhereUser.$whereUser ;
        }
        if($whereOrder != ''){
            $initWhereOrder = $initWhereOrder.$whereOrder;
        }

        $sql = "select 
                u.id,
                u.name,
                u.email,
                u.membership_number,
                u.user_refferal,
                u.user_level,
                u.uplinepath,
                u.user_code,
                u.user_role,
                u.registration_date,
                u.register_fee,
                u.user_status,
                o.totals
               
            from 
                users as u
            left join 
                (
                    select orders.user_id, sum(orders.total) as totals
                    from orders
                    where 
                        {$initWhereOrder}
                    group by orders.user_id
                ) as o

            on u.id = o.user_id
            where 
                {$initWhereUser}
            order by u.user_level
                ";

        return DB::select($sql);   
    }


}