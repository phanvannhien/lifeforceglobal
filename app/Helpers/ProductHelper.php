<?php
	namespace App\Helpers;
	use Config;
	use DB;


	class ProductHelper {
		public static function getThumbnail($pid){
			$product = DB::table('product')->where('id',$pid)->first();
			if($product)
				return $product->product_thumbnail;
			return false;
		}

		public static function getProductName($pid){
			$product = DB::table('product')->where('id',$pid)->first();
			if($product)
				return $product->product_name;
			return false;
		}

	}