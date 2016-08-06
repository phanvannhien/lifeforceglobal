<?php
	namespace App\Helpers;
	use Config;
	use DB;


	class ProductHelper {
		public static function getThumbnail($pid){

			$thumb = url('images/no-image.png');
			$product = DB::table('product')->where('id',$pid)->first();
			if( $product->product_thumbnail != ''){
			    $media = \App\Models\Medias::find($product->product_thumbnail);
			    $thumb = $media->file_url;
			}
			return $thumb;
		}

		public static function getProductName($pid){
			$product = DB::table('product')->where('id',$pid)->first();
			if($product)
				return $product->product_name;
			return false;
		}

	}