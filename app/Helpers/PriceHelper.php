<?php
	namespace App\Helpers;
	use Config;

	class PriceHelper {
		public static function formatPrice($price){
			if( Config::get('site.currency_position') == 'before' ){
				return Config::get('site.currency').' '.$price;
			}
			return Config::get('site.currency').$price; 
		}
	}