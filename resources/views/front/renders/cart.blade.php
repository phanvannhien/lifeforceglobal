@if ( count(Cart::content()) > 0)
    <div class="w100 miniCartTable scroll-pane">
        <table>
            <tbody>
            <?php $total = 0 ?>
            @foreach (Cart::content() as $item)
                <tr class="miniCartProduct">
                    <td style="width:20%" class="miniCartProductThumb">
                        <div>
                            
                            <a href="{{ route('front.product',[ $item->id, Str::slug($item->name)] ) }}">
                            <img src="{{ Image::url(ProductHelper::getThumbnail($item->id),70,80,array('crop')) }}" alt="img">
                            </a>
                        </div>
                    </td>
                    <td style="width:80%">
                        <div class="miniCartDescription">
                            <a href="{{ route('front.product',[ $item->id, Str::slug($item->name)] ) }}"> {{ $item->name }} </a>
                            <a href="{{ route('front.cart.delete',$item->rowid) }}"> x </a>
                            <p>Qty: {{ $item->qty }} <br>
                               {{ PriceHelper::formatPrice($item->price * $item->qty) }}     
                            </p>
                        </div>
                    </td>
                </tr>
                <?php $total +=  $item->price * $item->qty ?>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="miniCartFooter text-xs-center">
        <h3 class="text-right subtotal"> Total: {{ PriceHelper::formatPrice($total)}} </h3>
        <a class="btn btn-sm btn-danger" href="{{route('front.cart.page') }}"> <i class="fa fa-shopping-cart"> </i> VIEW CART </a>
        <a class="btn btn-sm btn-primary" href="{{route('front.cart.page') }}"> CHECKOUT </a></div>
@else
    <div class="w100 miniCartTable scroll-pane">
        <p style="padding:10px">Your cart is empty</p>
    </div>

@endif