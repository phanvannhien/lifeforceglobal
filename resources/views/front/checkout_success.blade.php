@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container ">
   <div class="row">
      <div class="col-lg-12 ">
         <div class="row userInfo">
            <div class="thanxContent text-center">
               <h2> Thank you for your order <a href="{{ route('front.order.status',$orderID) }}">{{ $orderID }}</a></h2>
               <h4>we'll let you know when your items are on their way</h4>
            </div>
         </div>
      </div>
   </div>
   <div style="clear:both"></div>
</div>
<div class="gap"></div>
@include ('front.includes.footer')