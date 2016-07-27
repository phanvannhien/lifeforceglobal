<?php
namespace App\Helpers;
use Config;

class PriceHelper {
	public static function formatPrice($price){
		if( Config::get('site.currency_position') == 'before' ){
			return ($price != null) ? Config::get('site.currency').' '.$price : Config::get('site.currency').' 0';
		}
		return ($price != null) ? $price.' '.Config::get('site.currency'): '0 '.Config::get('site.currency'); 
	}
}