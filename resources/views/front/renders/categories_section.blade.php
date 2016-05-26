@foreach( $categories as $category)

@if( $category->category_image != '' && $category->category_description != '' ) 
    

<section class="cat-section" style="background: {{ $category->category_color }}">
    <div class="container">
        <div class="row">

            @if( $category->image_position == 'left' )
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <p class="text-center">
                        <img src=" {!! $category->category_image !!}" alt="">
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    {!! $category->category_description !!}
                    <p class="clearfix">
                    <a class="btn btn-primary pull-right" href="{{ route('front.category',[ $category->id, Str::slug($category->category_name)])  }}">View more</a>
                    </p>
                </div>

            @else
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    {!! $category->category_description !!}
                    <p class="clearfix">
                    <a class="btn btn-primary pull-right" href="{{ route('front.category',[ $category->id, Str::slug($category->category_name)])  }}">View more</a>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <p class="text-center">
                        <img src=" {!! $category->category_image !!}" alt="">
                    </p>
                </div>
            @endif
        
        </div>
    </div>
</section>  

@endif
@endforeach