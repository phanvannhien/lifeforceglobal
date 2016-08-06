@extends('master')
@section('seo')
   {!!
      SEOHelper::renderSEO(array(
         'title' => 'Lifeforce | '.$product->product_name,
         'keywords' => 'Lifeforce'.$product->product_name,
         'description' => $product->product_sort_description,
         'og_title' => 'Lifeforce',
         'og_description' => 'Lifeforce',
         'og_url' => url('/') ,
         'og_sitename' => config('app.appname'),
         'og_img' => asset('img/logo.png'),
      ))

   !!}
@endsection
@section('content')
<div class="container main-container headerOffset">
   <div class="row transitionfx">
      <div class="col-lg-7 col-md-6 col-sm-6">
         <div class="main-image sp-wrap col-lg-12 no-padding">
             <?php
             $thumb = url('images/no-image.png');
             if( $product->product_thumbnail != ''){
                 $media = \App\Models\Medias::find($product->product_thumbnail);
                 $thumb = $media->file_url;
             }
             ?>

             <img src="{{ Image::url($thumb,500,500,array('crop')) }}" class="img-fluid" alt="img">
         </div>
      </div>
      <div class="col-lg-5 col-md-6 col-sm-5">
         <h2 class="product-title">{{$product->product_name}}</h2>
         <div class="product-price">
            <div class="price">
              @if (!Auth::check())
                  <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
              @else
                  <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
              @endif
            </div>
         </div>
         <div class="details-description">
            <p>{{$product->product_sort_description}}</p>
         </div>
         <a href="{{ url($product->download_file) }}">Click here to download File ( PDF )</a>
        <p>&nbsp;</p>

         <form action="{{ route('front.cart') }}" method="post" class="form-inline">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <select id="qty" name="qty" class="form-control">
               @for ($i = 1; $i <= 10 ;$i++)
               <option value="{{ $i }}">{{$i}}</option>
               @endfor
            </select>
             @if ( Site::getConfig('ajax_cart') == 'True')
               <a href="#" onclick="addcart(this)" class="addcart-ajax btn btn-primary"><span class="add2cart"><i class="fa fa-cart"> </i> Add to cart </span></a>
             @else
            <button onclick="" class="btn btn-primary btn-cart cart first" title="Add to Cart" type="submit">Add
               to Cart
            </button>
             @endif
         </form>
          <p>&nbsp;</p>
         <div style="clear:both"></div>
         <div class="product-share clearfix">
            <?php $product_url = route('front.product',array( $product->id,  Str::slug($product->product_name)) ) ?>

            <div class="socialIcon">
            <a href="https://www.facebook.com/dialog/share?app_id={{env('APP_FACEBOOK_ID')}}&amp;display=popup&amp;href={{$product_url}}&amp;redirect_uri={{route('front.product',array( $product->id,  Str::slug($product->product_name)) )}}"> <i class="fa fa-facebook"></i></a>
            <a href="{{$product_url}}" class="twitter-share-button large"> <i class="fa fa-twitter"></i></a>
            
            <a href="#"  class="g-plus" data-action="share" data-annotation="none" data-height="24"> <i class="fa fa-google-plus"></i></a> 
            
            </div>
         </div>
      </div>
   </div>

</div>
<div class="gap"></div>
@endsection

@section('footer')
<link rel="stylesheet" href="{{ url('assets/css/smoothproducts.css') }}">
<script src="{{ url('assets/js/jquery-migrate-1.2.1.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/smoothproducts.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/helper-plugins/jquery.mousewheel.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/jquery.mCustomScrollbar.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.touchspin.js') }}"></script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
 
  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
 
  return t;
}(document, "script", "twitter-wjs"));</script>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://apis.google.com/js/platform.js" async defer></script>

@endsection