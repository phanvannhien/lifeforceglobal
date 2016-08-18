<?php
namespace App\Helpers;
use Config;

class PriceHelper {
	public static function formatPrice($price){
		if( Config::get('site.currency_position') == 'before' ){
			return ($price != null) ? Config::get('site.currency').' '.number_format($price,2) : Config::get('site.currency').' 0';
		}
		return ($price != null) ? number_format($price,2).' '.Config::get('site.currency'): '0 '.Config::get('site.currency');
	}
}