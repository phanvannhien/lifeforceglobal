<?php
	namespace App\Helpers;
	use Config;
	use DB;
	use Auth;


	class CustomerHelper {
		public static function getAddressBook(){
			$address = DB::table('customers_address')->get();
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



	}