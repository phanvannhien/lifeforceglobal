<div class="morePost row featuredPostContainer style2 globalPaddingTop ">
    <h3 class="section-title style2 text-center"><span>
       LASTEST PRODUCTS
    </span></h3>
    <div class="container">
        <div class="row xsResponse">
            @foreach ($products as $product)
            <div class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
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
</div>