
@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
	<div class="row innerPage">
		<div class="col-lg-12 col-md-12 col-sm-12">
			@if ($isSuccessVerify)
			<h3>Verify your account successful!</h3>
			<p>Please login to continue...</p>
			@else
			<p>User verify not found!</p>
			@endif
		</div>
	</div>
 
	<div style="clear:both"></div>
</div>
 
<div class="gap"></div>

@include ('front.includes.footer')