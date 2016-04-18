<?php
	namespace App\Helpers;
	use Config;
	use DB;
	use Request;
	use Route;
	

	class SEOHelper {
		public static function renderSEO($seo){
			
			return view('front.renders.SEO',array('seo' => $seo))->render();
			$currentRoute = Request::route()->getName();
			switch ($currentRoute) {
				case 'front.product':
					# code...
					
					break;
				
				default:
					# code...
					break;
			}


		}
	}