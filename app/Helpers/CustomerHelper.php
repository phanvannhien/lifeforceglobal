<?php
	namespace App\Helpers;
	use Config;
	use DB;


	class CustomerHelper {
		public static function getAddressBook(){
			$address = DB::table('customers_address')->get();
			return $address;
		}


	}