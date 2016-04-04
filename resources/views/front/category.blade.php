@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
	 <div class="row">
        <div class="breadcrumbDiv col-lg-12">
           <ul class="breadcrumb">
              <li><a href="index.html">Home</a></li>
              <li class="active">MEN COLLECTION</li>
           </ul>
        </div>
     </div>
	<div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              @include('front.sidebar')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
               <div class="w100 clearfix category-top">
                  <h2>{{$category->category_name}}</h2>
               </div>
              
               <div class="w100 productFilter clearfix">
                  <p class="pull-left"> Showing <strong>{{$products->count()}}</strong> products </p>
                  <div class="pull-right ">
                     <div class="change-order pull-right">
                        <select class="form-control" name="orderby">
                           <option selected="selected">Default sorting</option>
                           <option value="popularity">Sort by popularity</option>
                           <option value="rating">Sort by average rating</option>
                           <option value="date">Sort by newness</option>
                           <option value="price">Sort by price: low to high</option>
                           <option value="price-desc">Sort by price: high to low</option>
                        </select>
                     </div>
                     <div class="change-view pull-right"><a href="#" title="Grid" class="grid-view"> <i class="fa fa-th-large"></i> </a> <a href="#" title="List" class="list-view "><i class="fa fa-th-list"></i></a></div>
                  </div>
               </div>
               <div class="row  categoryProduct xsResponse clearfix">
               		@foreach( $products as $product)
                   <div class="item col-sm-4 col-lg-4 col-md-4 col-xs-6">
                     <div class="product">
                        <div class="image">
                           <a href="{{route('front.product',$product->id)}}">
                           <img src="{{$product->product_thumbnail}}" alt="img" class="img-responsive"></a>
                        </div>
                        <div class="description">
                           <h4><a href="{{route('front.product',$product->id)}}">{{$product->product_name}}</a></h4>
                           <div class="grid-description">
                              <p>{{$product->product_sort_description}}</p>
                           </div>
                           <div class="list-description">
                              <p>{{$product->product_description}}
                              </p>
                           </div>
                           
                        </div>
                        <div class="price"><span>{{$product->price_RPP}}</span></div>
                        <div class="action-control"><a class="btn btn-primary"> <span class="add2cart"><i class="glyphicon glyphicon-shopping-cart"> </i> Add to cart </span> </a></div>
                     </div>
                   </div>
                 	@endforeach	
               </div>

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