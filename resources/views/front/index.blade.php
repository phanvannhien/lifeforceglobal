@include ('front.includes.header')
@include ('front.nav')
@include ('front.slider')

<div class="container main-container">
	
	{!! Site::renderProduct(null,'list',8) !!}
	

</div>
@include ('front.includes.footer')