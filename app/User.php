<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{


    protected $table = 'users';
    protected $guarded = array(
        'password','remember_token'
    );

    const USER_DEFAULT_ROLE = "OM";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
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

    public static function getMembersNumber( $user_id ){
      
        if( $user_id < 10 ){
            return '0000'.$user_id;
        }elseif ( $user_id < 100 ){
            return '000'.$user_id;
        }elseif ( $user_id < 1000 ){
            return '00'.$user_id;
        }elseif( $user_id < 10000 ){
            return '0'.$user_id;
        }
        return $user_id;
    }

    public static function getUserCode( $userCode,$referalCode, $userCity ){
        $uplineCode = '00000';
        if ($referalCode != ''){
            $uplineCode = $referalCode;
        }
        return self::USER_DEFAULT_ROLE.'-'.$userCode.'-'.$uplineCode.'-'.$userCity;
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
        $initWhereUser = "u.id IN ({$userID})";
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
                    select orders.user_id, sum(orders.total_include_tax) as totals
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


    public static function calCommissionForUserRootLevel(){
        // Filter by purchase date
        $date['startDate'] = date('Y-m-01');
        $date['endDate'] = date('Y-m-d');
        $whereOrder = " AND DATE(orders.created_at) >= '{$date['startDate']}' AND DATE(orders.created_at) <= '{$date['endDate']}'";

        $users = self::all();
        $usersRootLevel = self::where('user_level',0)->get();
        $totalComission = 0;
        foreach ($usersRootLevel as $perUser){
            $tempArr = array();
            array_push($tempArr,$perUser);
            $membersPurchase = User::getTotalPurchaseMembers($users,$whereOrder);
            $members = self::getUplineMembers($membersPurchase,$perUser->user_code,$tempArr);

            foreach ($members as $inTreeMembers){
                $totalComission += $inTreeMembers->commission;
            }
        }
        return $totalComission;
    }

    public static function getTotalSale(){
        $total = \App\Models\Orders::where('status','done')->sum('total_include_tax');
        return $total;
    }


}