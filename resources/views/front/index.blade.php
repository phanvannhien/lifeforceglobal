@include ('front.includes.header')
@include ('front.nav')
@include ('front.slider')

<div class="container main-container">
	{!! Site::renderProduct(1,'slider',8) !!}
	{!! Site::renderProduct(null,'list',8) !!}
	{!! Site::renderProduct(1,'list',8) !!}

</div>
@include ('front.includes.footer')