@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
   <div class="row">
      <div class="breadcrumbDiv col-lg-12">
         <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active"> Order List</li>
         </ul>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-7">
         <h1 class="section-title-inner"><span><i class="fa fa-list-alt"></i> Order Status </span></h1>
         <div class="row userInfo">
            <div class="col-lg-12">
               <h2 class="block-title-2"> Your Order Status </h2>
            </div>
            <div class="statusContent">
               <div class="col-sm-12">
                  <div class=" statusTop">
                     <p><strong>Status:</strong> {{ $order->status }}</p>
                     <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                     <p><strong>Order Number:</strong> {{ $order->id }} </p>
                  </div>
               </div>
             
               <div class="col-sm-12">
                  <div class="order-box">
                     <div class="order-box-header">
                        Shipping Address
                     </div>
                     <div class="order-box-content">
                        <div class="address">
                           <div class="adr">
                              {{ $order->getAddress->address }}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
 
               <div class="col-sm-12 clearfix">
                  <div class="order-box">
                     <div class="order-box-header">
                        Order Items
                     </div>
                     <div class="order-box-content">
                        <div class="table-responsive">
                           <table class="order-details-cart">
                              <tbody>
                              	@foreach ($order->details as $item )
                                 <tr class="cartProduct">
                                    <td class="cartProductThumb" style="width:20%">
                                       <div><a href=""> <img alt="img" src="{{ Image::url(ProductHelper::getThumbnail($item->product_id),285,380,array('crop')) }}">
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