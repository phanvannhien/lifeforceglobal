<h1>Thanks for your Orders: <a href="{{ route('front.order.status',$order->id) }}">#{{$order->id}}</a></h1>
<p>Lifefore happy to order your order: <a href="{{ route('front.order.status',$order->id) }}">#{{$order->id}}</a> has been received and is in processing. Lifefore will inform you as soon as the goods are delivered prepared.</p>

<h2>Order Infomations</h2>
<p><b>Shipping address:</b> {{ $order->address }}</p>
<hr>

<table class="" width="100%">
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
   				<strong>Total: {{ PriceHelper::formatPrice(Cart::total() + $order->shipping_fee ) }}</strong>
   			</td>
   		</tr>
   </tfoot>
</table>

<hr>
<h3>Payment infomations</h3>
{!! Site::getConfig('bank') !!}

<hr>

<p>You need support now? Just email <a href="mailto:info@lifeforceglobal.com.au">info@lifeforceglobal.com.au</a>.</p>
<hr>

<strong>Best regards!</strong>
