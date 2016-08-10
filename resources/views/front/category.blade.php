@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container">
	<div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              @include('front.sidebar')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <h3 class="title"><span class="d-inline">{{$category->category_name}}</span></h3>

              
               <div class="w100 productFilter clearfix">
                  <p class="pull-left"> Showing <strong>{{$products->count()}}</strong> products </p>

               </div>
               <div class="row  categoryProduct xsResponse clearfix">
               		@foreach( $products as $product)
                   <div class="item col-sm-4 col-lg-4 col-md-4 col-xs-6">
                     <div class="product">
                        <div class="image">
                           <a href="{{route('front.product',[ $product->id, Str::slug($product->product_name)] )}}">
                               <img src="{{Image::url(Site::getMediaUrl($product->product_thumbnail),233,235,array('crop'))}}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="description">
                           <h5><a href="{{route('front.product',[ $product->id, Str::slug($product->product_name)] )}}">{{$product->product_name}}</a></h5>
                        </div>
                        <div class="price">
                       @if (!Auth::check())
                        <span>{{ PriceHelper::formatPrice($product->price_RPP) }} </span>
                        @else
                        <span>{{  PriceHelper::formatPrice($product->price_discount) }}</span>
                        @endif
                        </div>
                        <div class="text-xs-center">
                        <form action="{{ route('front.cart') }}" method="post" class="form-inline">
                           <input type="hidden" name="product_id" value="{{ $product->id }}">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <select id="qty" name="qty" class="form-control" style="display:none">
                                <option value="1">1</option>
                            </select>
                            @if ( Site::getConfig('ajax_cart') == 'True')
                                <a href="#" onclick="addcart(this)" class="addcart-ajax btn btn-primary"><span class="add2cart"><i class="fa fa-cart"> </i> Add to cart </span></a>
                            @else
                                <button onclick="" class="btn btn-primary btn-cart cart first" title="Add to Cart" type="submit">Add
                                    to Cart
                                </button>
                            @endif
                        </form>
                        </div>
                     </div>
                   </div>
                 	@endforeach	
               </div>
                <p>&nbsp;</p>
               <div class="w100 categoryFooter">
                  <div class="pagination pull-left no-margin-top">
                     {!! $products->links() !!}
                  </div>
                  <div class="pull-right pull-right col-sm-4 col-xs-12 no-padding text-right text-left-xs">
                     <p>Showing {{$products->firstItem()}}/{{$products->lastItem()}} of {{$products->total()}} results</p>
                  </div>
               </div>
            </div>
         </div>

</div>
@include ('front.includes.footer')