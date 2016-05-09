@include ('front.includes.header')
@include ('front.nav')

<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="container main-container">
	
	{!! Site::renderCategoriesProducts() !!}

</div>
@include ('front.includes.footer')