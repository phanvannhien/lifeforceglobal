<div class="row featuredPostContainer globalPadding style2">
    <h3 class="section-title style2 text-center"><span>
        <a href="{{ route('front.category',$category->id) }}">{{$category->category_name}}</a>
    </span></h3>
    <div id="productslider" class="owl-carousel owl-theme">
        @foreach ($products as $product)
        <div class="item">
            <div class="product">
                <div class="image">
                    <a href="{{route('front.product',$product->id)}}">
                    <img src="{{ Image::url($product->product_thumbnail,285,380,array('crop')) }}" alt="img" class="img-responsive"></a>
                    
                </div>
                <div class="description">
                    <h4><a href="{{route('front.product',$product->id)}}">{{$product->product_name}}</a></h4>
                    <p>{{$product->product_sort_description}}</p>
                </div>
                 <div class="price">
                @if (!Auth::check())
                        <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
                    @else
                        <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
                    @endif
                </div>
                @if (Auth::check())
                <div class="action-control">
                    <form action="{{ route('front.cart') }}" method="post" >
                       <input type="hidden" name="product_id" value="{{ $product->id }}">
                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <input type="hidden" name="qty" value="1">
                       <div class="action-control"><button type="submit" class="btn btn-primary">
                        <span class="add2cart"><i class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </button></div>
                    </form>
                </div>
                @else
                          <p>&nbsp;</p>
                @endif
            </div>
        </div>
        @endforeach 
    </div>

</div>