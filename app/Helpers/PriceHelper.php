<?php
	namespace App\Helpers;
	use Config;

	class PriceHelper {
		public static function formatPrice($price){
			if( Config::get('site.currency_position') == 'before' ){
				return $price. ' '. Config::get('site.currency');
			}
			return Config::get('site.currency').$price; 
		}
	}