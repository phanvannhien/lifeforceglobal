<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;
use Hash;
use Mail;
use App\User;
use Session;
use App\Models\Orders;
use Site;
use Cart;
use CustomerHelper;
use Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class ReportController extends Controller
{
	public function __construct(){
		DB::enableQueryLog();
	}
	public function reportboard(Request $request){
				
		// Create rules
		$rules = array(
			'report_date' => 'required'
		);
		$v = Validator::make($request->all(),$rules);
        if ($v->fails())
        {
            return view('back.reportboard')->withErrors($v);
        }
		// Get filter array	
		$filters = $request->input('filter');
		$whereUser = 'u.user_status = 1 AND u.user_role = "WM"';

		if( count($filters) > 0 ){
			foreach ($filters as $key => $value) {
				if( $value != '' ){
					$whereUser .= ' AND u.'.$key.' = "'.$value.'"';
				}
			}
		} 

		
		$arrDate =  explode('-', $request->report_date);
		$startDate = date('Y-m-d H:s:i',strtotime($arrDate[0]));
		$endDate = date('Y-m-d H:s:i',strtotime($arrDate[1]));
		$whereOrders = 'orders.status = "done" AND orders.checkout_type = "member" ';//where orders filter
		$whereOrders .= "AND DATE(orders.created_at) >= '{$startDate}' AND DATE(orders.created_at) <= '{$endDate}'";
		
		$sql = "select 
			u.id,
			u.name, 
			u.email, 
			u.user_code,
			u.user_refferal,
			u.membership_number,
			u.registration_date,
			o.totals,
			IF (o.totals > 3000,o.totals * 10 / 100, 0 ) as commission
		from 
			(
				select orders.user_id, sum(orders.total) as totals
				from orders
				where 
					{$whereOrders}
				group by orders.user_id
			) as o

			inner join users as u
			on u.id = o.user_id

		where $whereUser";

		$results = DB::select($sql);
		
		//$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$currentPage = $request->input('page', 1) - 1;
		$collection = new Collection($results);
		// Paginate
		$perPage = 1; // Item per page
		//Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();
        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));

        return view('back.reportboard',[ 'users' => $paginatedSearchResults ]);

	}
	
}