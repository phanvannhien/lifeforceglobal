@include ('front.includes.header')
@include ('front.nav')
<div id="main-banner" class="parallax-container valign-wrapper">
    <div class="container ">
        <div class="pull-xs-right">

        </div>
    </div>
    <div class="parallax"><img src="{{url('images/slide.png')}}"></div>
</div>

<div class="container main-container">
    <div class="container">
        <div class="row">
            @foreach (\App\Models\Categories::all() as $cat)
         
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="service-item">
                    <div class="block-blur">
                        <img src="{{Image::url(Site::getMediaUrl($cat->category_image),233,235,array('crop'))}}" class="img-fluid" alt="">
                        <div class="block-blur-content">
                            <span>{{ Site::limit_words($cat->category_description,10,'') }}</span>
                        </div>
                    </div>
                    <div class="service-info">
                        <h3 class="service-info-title">{{ $cat->category_name }}</h3>
                        <a href="{{ route('front.category',[ $cat->id, Str::slug($cat->category_name)])  }}"><i class="fa fa-plus"></i> View more</a>
                    </div>
                </div>

            </div>
            @endforeach
            
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <h3 class="title text-xs-center">
                    <span class="d-inline">WHY DO I </span>
                    <span class="d-inline">NEED</span>
                    <span class="d-inline">PROBIOTIC?</span></h3>
                <ul class="style-list">
                    <li><a href="#" class="">VISIT OUR</a></li>
                    <li><a href="#" class="">FAQ</a></li>
                </ul>
                <h3 class="title text-xs-center">
                    <span class="d-inline">WHAT ARE THE </span>
                    <span class="d-inline"> BENEFITS?</span></h3>
                <ul class="style-list">
                    <li><a href="{{ route('front.aboutus') }}" class="">VISIT OUR</a></li>
                    <li><a href="#" class="">VISIT BLOG</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


@include ('front.includes.footer')