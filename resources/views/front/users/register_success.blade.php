
@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
	<div class="row innerPage">
		<div class="col-lg-12 col-md-12 col-sm-12">
			@if (Session::has ('user_registered'))
			<h3>Please check your email to verify your account!</h3>
			<a href="{{ route('user.verify.resend') }}">Resend email active</a>
			@else
			<p>Hello</p>
			@endif
		</div>
	</div>
 
	<div style="clear:both"></div>
</div>
 
<div class="gap"></div>

@include ('front.includes.footer')