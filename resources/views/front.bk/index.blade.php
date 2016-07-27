@include ('front.includes.header')
@include ('front.nav')
<p>&nbsp;</p>
<p>&nbsp;</p>
{!! Site::renderCategoriesSections() !!}
{!! Site::renderCategoriesProducts() !!}
@include ('front.includes.footer')