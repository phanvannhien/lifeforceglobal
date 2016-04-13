@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
   <div class="row">
      <div class="breadcrumbDiv col-lg-12">
         <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="category.html">MEN COLLECTION</a></li>
            <li><a href="sub-category.html">TSHIRT</a></li>
            <li class="active">Lorem ipsum dolor sit amet</li>
         </ul>
      </div>
   </div>
   <div class="row transitionfx">
      <div class="col-lg-6 col-md-6 col-sm-6">
         <div class="main-image sp-wrap col-lg-12 no-padding">
            <a href="{{ url('media/product/images/'.$product->product_images )}}">
            <img src="{{ url('media/product/images/'.$product->product_images )}}" class="img-responsive" alt="img"></a>
         </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-5">
         <h1 class="product-title">{{$product->product_name}}</h1>
         <h3 class="product-code"></h3>
        
         <div class="product-price">
        
         <div class="price">
            @if (Auth::check())
               <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
            @else
               <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
            @endif
         </div>
      
         </div>
         <div class="details-description">
            <p>{{$product->product_sort_description}}</p>
         </div>
         
         <form action="{{ route('front.cart') }}" method="post" >
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="productFilter productFilterLook2">
               <div class="row">
                  <div class="col-lg-6 col-sm-6 col-xs-6">
                     <div class="filterBox">
                        <select name="qty" class="form-control">
                           @for ($i = 1; $i <= 10 ;$i++)
                           <option value="{{ $i }}">{{$i}}</option>
                           @endfor
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="cart-actions">
               <div class="addto row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <button onclick="" class="button btn-block btn-cart cart first" title="Add to Cart" type="submit">Add
                     to Cart
                     </button>
                  </div>
               </div>
               <div style="clear:both"></div>
               <h3 class="incaps"><i class="fa fa fa-check-circle-o color-in"></i> In stock</h3>
               <h3 style="display:none" class="incaps"><i class="fa fa-minus-circle color-out"></i> Out of stock</h3>
               <h3 class="incaps"><i class="glyphicon glyphicon-lock"></i> Secure online ordering</h3>
            </div>
         </form>

         <div class="clear"></div>
         <div class="product-tab w100 clearfix">
            <ul class="nav nav-tabs">
               <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
               <li class=""><a href="#download-file" data-toggle="tab">Download File</a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="details">{!! $product->product_description !!}
               </div>
               <div class="tab-pane" id="download-file">
                     <a href="{{ url('media/product/'.$product->download_file) }}">Click here to download File ( PDF )</a>

               </div>
            </div>
         </div>
         <div style="clear:both"></div>
         <div class="product-share clearfix">
            <p> SHARE </p>
            <div class="socialIcon">
            <a href="#"> <i class="fa fa-facebook"></i></a>
            <a href="#"> <i class="fa fa-twitter"></i></a>
            <a href="#"> <i class="fa fa-google-plus"></i></a> 
            <a href="#"><i class="fa fa-pinterest"></i></a>
            </div>
         </div>
      </div>
   </div>
   <div class="row recommended">
      {!! Site::renderProductCarousel('You may also like',$product->category_id,$product->id) !!}
   </div>
   <div style="clear:both"></div>
</div>
<div class="gap"></div>
@include ('front.includes.footer')

<script type="text/javascript" src="{{ url('assets/js/smoothproducts.min.js') }}"></script>