<?php 
	namespace App\Helpers;
	use DB;
	class SiteHelper{
		public static function NavData(){
			return DB::table('categories')->where('category_status',1)->get();
		}

		public static function allCategories(){
			return DB::table('categories')->where('category_status',1)->get(); 
		}

		public static function renderProductCarousel($title, $category_id, $excluded_id){
			$products = DB::table('product')
			->where('category_id',$category_id)
			->whereNotIn('id',array($excluded_id))
			->take(10)->get();
			return view('front.renders.product_carousel',array("title" => $title, "products" => $products))
			->render();
		}

		public static function renderProduct($CategoryID = null, $displayType = 'list', $limit){
			if( !is_null($CategoryID) ){
				$products = DB::table('product')
				->where('category_id',$CategoryID)
				->take($limit)->get();

				$category = DB::table('categories')
				->where('id',$CategoryID)
				->first();

			}else{
				$products = DB::table('product')
				->orderBy('id','DESC')
				->take($limit)->get();
			}

			
			if( $displayType == 'slider' && !is_null($CategoryID) ){
				return view('front.renders.product_category_slider',array("category"=>$category,"products" => $products))
				    ->render();
			}

			if( $displayType == 'list' && !is_null($CategoryID) ){
				return view('front.renders.product_category_list',array("category"=>$category,"products" => $products))
			    ->render();
			}

			if( $displayType == 'slider' && is_null($CategoryID) ){
				return view('front.renders.product_slider',array( "products" => $products))->render();
			}

			return view('front.renders.product_list',array( "products" => $products))->render();		

		}

		public static function getTotalOrders(){
			return DB::table('orders')->count();
		}
		public static function getTotalUsers(){
			return DB::table('users')->count();
		}

		public static function getTotalRevenue(){
			return DB::table('orders')->where('status','done')->sum('total');
		}

		public static function getDataSalesCurrentWeek(){
			

			$sunday = strtotime('last sunday', strtotime('tomorrow'));
			$statuday = strtotime('+6 days', $sunday);
			$arrSaleOfWeek = array();
			for($i = date('d',$sunday); $i<= date('d',$statuday); $i++  ) {
				# code...

				$vanue = DB::table('orders')
					->whereDate('created_at','=',date('Y-m-'.$i.' 00:00:00'))
					->count();

				array_push($arrSaleOfWeek,$vanue);

			}
			
			return json_encode($arrSaleOfWeek);
		}

		public static function getUsersRegistredToday(){
			return DB::table('users')
				->whereDate('created_at','=',date('Y-m-d 00:00:00'))
				->where('user_status',0)
				->count();
		} 

		public static function getSalesPendingToday(){
			return DB::table('orders')
				->whereDate('created_at','<=',date('Y-m-d 00:00:00'))
				->where('status','pending')
				->count();
		} 

		public static function renderConfig($config){
			return view('back.renders.config', array('config' => $config ) );
		}

		public static function getConfig($name){
			$config = DB::table('configuration')
				->where('name',$name)->first();
			return 	$config->value;
		}
	}
