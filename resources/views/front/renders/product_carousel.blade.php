<h1>{{$title}}</h1>
<div id="SimilarProductSlider">
   @foreach ($products as $product)
   <div class="item">
      <div class="product">
         <a href="{{route('front.product',[ $product->id, Str::slug($product->product_name)] )}}" class="product-image">
         <img src="{{ Image::url($product->product_thumbnail,285,380,array('crop')) }}" alt="img"> </a>
         <div class="description">
            <h4><a href="{{route('front.product',[ $product->id, Str::slug($product->product_name)])}}">{{$product->product_name}}</a></h4>
            <div class="price">
           @if (!Auth::check())
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