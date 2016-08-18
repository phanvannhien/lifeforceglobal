@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">

   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
         <h2 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order Status </span></h2>
         <div class="row userInfo">

            <div class="statusContent">
               <div class="col-sm-12">
                  <div class=" statusTop">
                     <p><strong>Status:</strong> {{ $order->status }}</p>
                     <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                     <p><strong>Order Number:</strong> {{ $order->id }} </p>
                     <p><strong>Shipping Address:</strong> {{ $order->address }} </p>
                     <p><strong>Shipping Fee:</strong> {{ \App\Helpers\PriceHelper::formatPrice($order->shipping_fee) }} </p>
                     <p><strong>GST Tax:</strong> {{ PriceHelper::formatPrice($order->gst_tax) }} </p>
                     <p><strong>Total included shipping fee:</strong> {{ PriceHelper::formatPrice($order->shipping_fee + $order->total_include_tax) }} </p>
                  </div>
               </div>
 
               <div class="col-sm-12 clearfix">
                  <div class="order-box">
                     <div class="order-box-header">
                        <p>&nbsp;</p>
                        <h3>Order Items</h3>
                     </div>
                     <div class="order-box-content">
                        <div class="table-responsive">
                           <table class="table table-tripped order-details-cart">
                              <tbody>
                              	@foreach ($order->details as $item )
                                   
                                 <tr class="cartProduct">
                                    <td class="cartProductThumb" style="width:20%">
                                       <div><a href="">
                                             <img alt="img" src="{{ Image::url(ProductHelper::getThumbnail($item->product_id),80,100,array('crop')) }}">
                                          </a>
                                       </div>
                                    </td>
                                    <td style="width:40%">
                                       <div class="miniCartDescription">
                                          <h4><a href=""> {{ ProductHelper::getProductName($item->product_id) }} </a></h4>
                                          <div class="price"><span>{{ PriceHelper::formatPrice($item->price) }}</span></div>
                                       </div>
                                    </td>
                                    <td class="" style="width:10%"><a> X {{ $item->qty }} </a></td>
                                    <td class="" style="width:15%"><span> {{ PriceHelper::formatPrice($item->subtotal) }} </span></td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12 clearfix">
               <ul class="pager">
                  <li class="previous pull-right"><a href="/"> <i class="fa fa-home"></i> Go to Shop </a></li>
                  <li class="next pull-left"><a href="{{ route('user.dashboard') }}"> ← Back to My Account</a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-5"></div>
   </div>
   <div style="clear:both"></div>
</div>
<div class="gap"></div>

@include ('front.includes.footer')