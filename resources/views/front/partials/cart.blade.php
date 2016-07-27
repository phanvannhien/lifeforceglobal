<div class="abside" style="display: none">
    <div class="side-cart">
        <div class="heading-cart">
            Cart
        </div>
        <div class="content-cart">
            @if ( count(Cart::content()) > 0)
                <div class="w100 miniCartTable scroll-pane">
                    <table>
                        <tbody>
                        <?php $total = 0 ?>
                        @foreach (Cart::content() as $item)

                            <tr class="miniCartProduct">
                                <td style="width:20%" class="miniCartProductThumb">
                                    <div>
                                        <a href="{{ route('front.product',[ $item->id, Str::slug($item->name)] ) }}"> <img src="{{ Image::url(ProductHelper::getThumbnail($item->id),285,380,array('crop')) }}" alt="img">
                                        </a>
                                    </div>
                                </td>
                                <td style="width:40%">
                                    <div class="miniCartDescription">
                                        <h4><a href="{{ route('front.product',[ $item->id, Str::slug($item->name)] ) }}"> {{ $item->name }} </a></h4>
                                        <div class="price"><span> {{ $item->price }} </span></div>
                                    </div>
                                </td>
                                <td style="width:10%" class="miniCartQuantity"><a> X {{ $item->qty }}</a></td>
                                <td style="width:15%" class="miniCartSubtotal"><span> {{ $item->price * $item->qty }} </span></td>
                                <td style="width:5%" class="delete"><a href="{{ route('front.cart.delete',$item->rowid) }}"> x </a></td>
                            </tr>
                            <?php $total +=  $item->price * $item->qty ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="miniCartFooter text-right">
                    <h3 class="text-right subtotal"> Subtotal: {{$total}} </h3>
                    <a class="btn btn-sm btn-danger" href="{{route('front.cart.page') }}"> <i class="fa fa-shopping-cart"> </i> VIEW CART </a>
                    <a class="btn btn-sm btn-primary" href="{{route('front.cart.page') }}"> CHECKOUT </a></div>
            @else
                <div class="w100 miniCartTable scroll-pane">
                    <p style="padding:10px">Your cart is empty</p>
                </div>

            @endif
        </div>
    </div>
</div>