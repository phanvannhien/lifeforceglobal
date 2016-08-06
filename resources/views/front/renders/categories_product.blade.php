@foreach( $categories as $category)
@if( count($category->product) > 0 )

<div class="row featuredPostContainer style2 globalPaddingTop ">
    <h3 class="title"><span class="d-inline">
       {{ $category->category_name }}
    </span></h3>

    <div class="container">
        <div class="row">
            @foreach ($category->product as $product)
            <div class="pitem col-lg-3 col-md-3 col-sm-4 col-xs-6">
                <div class="product">
                    <div class="image">
                        <?php
                            $thumb = url('images/no-image.png');
                            if( $product->product_thumbnail != ''){
                                $media = \App\Models\Medias::find($product->product_thumbnail);
                                $thumb = $media->file_url;
                            }
                        ?>
                        <a href="{{route('front.product',array( $product->id,  Str::slug($product->product_name)) )}}">
                        <img src="{{ Image::url($thumb,285,380,array('crop')) }}" alt="img" class="img-fluid"></a>
                    </div>
                    <div class="description">
                        <h4 class="pname"><a href="{{route('front.product',array( $product->id,  Str::slug($product->product_name)) )}}">{{$product->product_name}}</a></h4>
                    </div>
                    <div class="price">
                    @if (!Auth::check())
                        <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
                    @else
                        <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
                    @endif
                    </div>
                    <div class="action-control text-xs-center">
                    
                        <form action="{{ route('front.cart') }}" method="post" >
                           <input type="hidden" name="product_id" value="{{ $product->id }}">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <select id="qty" name="qty" class="form-control" style="display:none">
                               <option value="1">1</option>
                            </select>
                            @if ( Site::getConfig('ajax_cart') == 'True')
                            <a href="#" onclick="addcart(this)" class="addcart-ajax btn btn-primary"><span class="add2cart"><i class="fa fa-cart"> </i> Add to cart </span></a>
                            @else
                           <div class="action-control"><button type="submit" class="btn btn-primary">
                            <span class="add2cart"><i class="fa fa-cart"> </i> Add to cart </span> </button></div>

                            @endif    
                        </form>
                    
                    
                    </div>
                </div>
            </div>
           @endforeach 
        </div>

    </div>
</div>
@endif
@endforeach
