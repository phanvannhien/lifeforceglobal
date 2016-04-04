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
            <a href="{{$product->product_images}}"><img src="{{$product->product_images}}" class="img-responsive" alt="img"></a>
         </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-5">
         <h1 class="product-title">{{$product->product_name}}</h1>
         <h3 class="product-code"></h3>
        
         <div class="product-price"><span class="price-sales">{{$product->price_discount}}</span>
         <span class="price-standard">{{$product->price_RPP}}</span></div>
         <div class="details-description">
            <p>{{$product->product_sort_description}}</p>
         </div>
         
         <div class="productFilter productFilterLook2">
            <div class="row">
               <div class="col-lg-6 col-sm-6 col-xs-6">
                  <div class="filterBox">
                     <select class="form-control">
                        <option value="strawberries" selected>Quantity</option>
                        <option value="mango">1</option>
                        <option value="bananas">2</option>
                        <option value="watermelon">3</option>
                        <option value="grapes">4</option>
                        <option value="oranges">5</option>
                        <option value="pineapple">6</option>
                        <option value="peaches">7</option>
                        <option value="cherries">8</option>
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="cart-actions">
            <div class="addto row">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <button onclick="productAddToCartForm.submit(this);" class="button btn-block btn-cart cart first" title="Add to Cart" type="button">Add
                  to Cart
                  </button>
               </div>
            </div>
            <div style="clear:both"></div>
            <h3 class="incaps"><i class="fa fa fa-check-circle-o color-in"></i> In stock</h3>
            <h3 style="display:none" class="incaps"><i class="fa fa-minus-circle color-out"></i> Out of stock</h3>
            <h3 class="incaps"><i class="glyphicon glyphicon-lock"></i> Secure online ordering</h3>
         </div>
         <div class="clear"></div>
         <div class="product-tab w100 clearfix">
            <ul class="nav nav-tabs">
               <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane active" id="details">{{$product->product_description}}
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