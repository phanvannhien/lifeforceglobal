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
                    <img src="{{ url('media/product/images/'.$product->product_thumbnail) }}" alt="img" class="img-responsive"></a>
                    
                </div>
                <div class="description">
                    <h4><a href="{{route('front.product',$product->id)}}">{{$product->product_name}}</a></h4>
                    <p>{{$product->product_sort_description}}</p>
                </div>
                 <div class="price">
                @if (Auth::check())
                    <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
                @else
                    <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
                @endif
                </div>
                <div class="action-control">
                    <a class="btn btn-primary"> <span class="add2cart"><i class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a>
                </div>
            </div>
        </div>
        @endforeach 
    </div>

</div>