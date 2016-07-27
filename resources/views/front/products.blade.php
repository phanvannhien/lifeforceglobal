@include ('front.includes.header')
@include ('front.nav')
<div class="top-banner">
    <a href="#">
        <img class="img-fluid" src="{{url('images/product-page-banner.jpg')}}" alt="">
    </a>
</div>
<div class="container main-container headerOffset">

{!! Site::renderCategoriesProducts() !!}

</div>
@include ('front.includes.footer')