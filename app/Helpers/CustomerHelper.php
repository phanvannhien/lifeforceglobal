<?php
	namespace App\Helpers;
	use Config;
	use DB;
	use Auth;
	use Cart;
	use App\User;
	use App\Models\Products;

	class CustomerHelper {
		public static function getAddressBook($userID){
			$address = DB::table('customers_address')
			->where('user_id',$userID)
			->get();
			return $address;
		}

		public static function getOrders(){
			return DB::table('orders')->where('user_id', Auth::user()->id )->orderBy('id','DESC')->get();
		}

		public static function getCountItemOrders($orderID){
			return DB::table('orders_detail')
				->where('order_id', $orderID)
				->count();
		}

		public static function reduceCart(){
		   $cart = Cart::content();
		   if( count($cart) ){
		     foreach($cart as $item){
		         $product = Products::find($item->id);
		         $price = (Auth::check()) ? $product->price_discount : $product->price_RPP;
		         Cart::update($item->rowid, ['price' => $price]);
		     }
		   }
		}


		public static function getCommissionWMUserByDate($userID, $startDate, $endDate){
			
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
						orders.status = 'done' AND 
						orders.checkout_type = 'member' AND
						DATE(orders.created_at) >= '{$startDate}' AND DATE(orders.created_at) <= '{$endDate}'
					group by orders.user_id
				) as o

				inner join users as u
				on u.id = o.user_id

			where 
				u.user_status = 1 AND
				u.user_role = 'WM' AND 
				u.id = {$userID}";

			return DB::select($sql);
		}

		public static function checkWMUserRevanue3Month(){
			$sql = "select 
				u.id,
				u.name, 
				u.email, 
				u.user_code,
				u.user_refferal,
				u.membership_number,
				u.registration_date,
				o.totals
			from 
				(
					select orders.user_id, sum(orders.total) as totals
					from orders
					where 
						orders.status = 'done' AND
						orders.checkout_type = 'member' AND 
						orders.created_at >= DATE(NOW() - INTERVAL 3 MONTH)
					group by orders.user_id
				) as o

				inner join users as u
				on u.id = o.user_id

			where 
				u.user_status = '1' AND
				u.user_role = 'WM' AND 
				o.totals < 1500";

			$data = DB::select($sql);	
			
			return view('back.renders.wm_commission', [ 'data' => $data ]);

		}

		public static function checkUserNotPurchase2Month(){
			$sql = "select 
				u.id,
				u.name, 
				u.email, 
				u.user_code,
				u.user_refferal,
				u.membership_number,
				u.registration_date

			from 
				users as u
			where 
				u.id not in (
					select o.user_id
					from orders as o
					where 
						o.status = 'done' AND
						o.checkout_type = 'member' AND 
						o.created_at >= DATE(NOW() - INTERVAL 2 MONTH)
				) AND

				u.user_status = '1' AND
				u.user_role = 'BM' ";

			$data = DB::select($sql);	
			
			return view('back.renders.member_perchase', [ 'data' => $data ]);
		}
		
		public static function getCommissionOneMonthofHeadMembers($members,$totalPurchase,$date){
			if( count($members) >= 39 &&  $date['startDate'] ){

			}
		}
	
	}