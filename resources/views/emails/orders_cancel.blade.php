<h1>Your Orders are canceled: <a href="{{ route('front.order.status',$order->id) }}">#{{$order->id}}</a></h1>

<p>Your Orders canceled at {{ config('app.sitename') }}.</p>
<h2>Order Infomations</h2>
<p><b>Shipping address:</b> {{ $order->address }}</p>
<hr>

<table class="">
   <tbody>
   	@foreach ($order->details as $item )
      <tr class="">
         <td class="" style="width:20%">
            <div><a href=""> <img alt="img" src="{{ Image::url(ProductHelper::getThumbnail($item->product_id),285,380,array('crop')) }}">
               </a>
            </div>
         </td>
         <td style="width:40%">
            <div class="">
               <h4><a href=""> {{ ProductHelper::getProductName($item->product_id) }} </a></h4>
               <div class="price"><span>{{ PriceHelper::formatPrice($item->price) }}</span></div>
            </div>
         </td>
         <td class="" style="width:10%"><a> X {{ $item->qty }} </a></td>
         <td class="" style="width:15%"><span> {{ PriceHelper::formatPrice($item->subtotal) }} </span></td>
      </tr>
      @endforeach
   </tbody>
   <tfoot>
          <tr>
            <td colspan="4" align="right">
               <strong>Shipping Fee: {{ PriceHelper::formatPrice($order->shipping_fee) }}</strong>
            </td>
         </tr>
   		<tr>
   			<td colspan="4" align="right">
   				<strong>Total: {{ PriceHelper::formatPrice($order->total + $order->shipping_fee) }}</strong>
   			</td>
   		</tr>
   </tfoot>
</table>

<p>You need support now? Just email <a href="mailto:info@lifeforceglobal.com.au">info@lifeforceglobal.com.au</a>.</p>
<hr>

<strong>Best regards!</strong>
