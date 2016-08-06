@include ('front.includes.header')
@include ('front.nav')
<div class="parallax-container valign-wrapper">
    <div class="container ">
        <div class="pull-xs-right">
            <h1 class="header text-xs-right text-white">Our Products</h1>
            <p class="text-xs-right text-white">Parallax is an effect where the background content or image in this case, is moved at a different speed than the foreground content while scrolling.</p>
        </div>
    </div>
    <div class="parallax"><img src="{{url('images/product-page-banner.jpg')}}"></div>
</div>

<div class="container main-container headerOffset">

{!! Site::renderCategoriesProducts() !!}

</div>
@include ('front.includes.footer')