<?php 
	namespace App\Helpers;
	use DB;
	class SiteHelper{
		public static function NavData(){
			return DB::table('categories')->get();
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
	}
