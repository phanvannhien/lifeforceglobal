@include ('front.includes.header')
@include ('front.nav')
<?php $total = 0 ?>
<div class="container main-container">
	
	<h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> My Cart </span></h1>

	<div class="row">
	   <div class="col-lg-9 col-md-9 col-sm-7">
	      <div class="row userInfo">
	         <div class="col-xs-12 col-sm-12">
	         	@if(count($cart))
				<form action="{{ route('front.cart.update') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
		            <div class="cartContent w100">
		            	
		               <table class="cartTable table-responsive" style="width:100%">
		                  <tbody>
		                     <tr class="CartProduct cartTableHeader">
		                        <td style="width:15%">Product</td>
		                        <td style="width:50%">Details</td>
		                        <td style="width:10%">QNT</td>
		                        <td style="width:10%">Discount</td>
		                        <td style="width:15%">Total</td>
		                     </tr>
		                     
		                     @foreach($cart as $item)
								
		                     <tr class="CartProduct">
		                        <td class="CartProductThumb">
		                           <div><a href="{{ route('front.product',[ $item->id, Str::slug($item->name)] ) }}">
		                           <img src="{{ Image::url(ProductHelper::getThumbnail($item->id),285,380,array('crop')) }}" alt="img"></a></div>
		                        </td>
		                        <td>
		                           <div class="CartDescription">
		                              <h4><a href="{{ route('front.product',[ $item->id, Str::slug($item->name)] ) }}">{{ $item->name }} </a></h4>
		                              <div class="price"><span>{{ PriceHelper::formatPrice($item->price) }}</span></div>
		                              <a href="{{ route('front.cart.delete',$item->rowid) }}" title="Delete"> <i class="fa fa-remove"></i></a>
		                           </div>
		                        </td>
		                       
		                        <td>
		                        	<input class="quanitySniper" min="1" max="100" type="number" value="{{ $item->qty }}" name="qty[{{$item->rowid}}]">
		                        </td>
		                        <td>0</td>
		                        <td class="price">{{ PriceHelper::formatPrice($item->price * $item->qty) }}</td>
		                     </tr>
		                      <?php PriceHelper::formatPrice($total += $item->price * $item->qty) ?>
		               		@endforeach
		                     
		                  </tbody>
		               </table>
		              
		            </div>
		            <div class="cartFooter w100">
		               <div class="box-footer">
		                  <div class="pull-left"><a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-default"> <i class="fa fa-arrow-left"></i> &nbsp; Continue shopping </a></div>
		                  <div class="pull-right">
		                     <button type="submit" name="update_cart" class="btn btn-default"><i class="fa fa-undo"></i> &nbsp; Update
		                     cart
		                     </button>
		                  </div>
		               </div>
		            </div>
				</form>
				@else
               		<p>Your cart is empty!</p>
                @endif
	         </div>
	      </div>
	   </div>
	   <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar">
	      <div class="contentBox">
	         <div class="w100 costDetails">
	            <div class="table-block" id="order-detail-content">
	            	
	               	<a class="btn btn-primary btn-lg btn-block " title="checkout" 
	               		href="{{ route('front.checkout') }}" style="margin-bottom:20px"> 
	               	@if (Auth::check())	
	               		Checkout &nbsp; 
					@else
						Guest checkout &nbsp; 
					@endif
	                <i class="fa fa-arrow-right"></i> </a>
					

	                <div class="w100 cartMiniTable">
	                  <table id="cart-summary" class="std table">
	                     <tbody>
	                        <tr>
	                           <td>Total products</td>
	                           <td class="price">{{ PriceHelper::formatPrice($total) }}</td>
	                        </tr>
	                        <tr style="">

	                           <td class="price" colspan="2"><span class="success">Shipping 10$ in Australia</span></td>
	                        </tr>

	                        <tr>
	                           <td> Total</td>
	                           <td class=" site-color" id="total-price">{{ PriceHelper::formatPrice($total + 10) }}</td>
	                        </tr>
	                        <!--
	                        <tr>
	                           <td colspan="2">
	                              <div class="input-append couponForm">
	                                 <input class="col-lg-8" id="appendedInputButton" type="text" placeholder="Coupon code">
	                                 <button class="col-lg-4 btn btn-success" type="button">Apply!</button>
	                              </div>
	                           </td>
	                        </tr>
	                        -->
	                     </tbody>
	                     <tbody></tbody>
	                  </table>
	               </div>
	            </div>
	         </div>
	      </div>
	   </div>
	</div>
	<div style="clear:both"></div>
	</div>
	<div class="gap"></div>
</div>

@include ('front.includes.footer')