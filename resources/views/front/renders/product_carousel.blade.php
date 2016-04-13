<h1>{{$title}}</h1>
<div id="SimilarProductSlider">
   @foreach ($products as $product)
   <div class="item">
      <div class="product">
         <a class="product-image"> <img src="{{ url('media/product/images/'.$product->product_thumbnail) }}" alt="img"> </a>
         <div class="description">
            <h4><a href="san-remo-spaghetti">{{$product->product_name}}</a></h4>
            <div class="price">
            @if (Auth::check())
               <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
            @else
               <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
            @endif
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>