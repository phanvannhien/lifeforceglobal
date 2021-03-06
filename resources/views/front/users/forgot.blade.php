
@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
	

	@include('front.partials.message')

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<h1 class="section-title-inner"><span> <i class="fa fa-unlock-alt"> </i> Forgot your password? </span></h1>
			<p>&nbsp;</p>
			<div class="row userInfo">
				<div class="col-xs-12 col-sm-12">
				<p> To reset your password, enter the email address you use to sign in to site. We will then send
				you a new password. </p>
				<form id="frm-forgot" method="post" role="form" action="{{ route('user.forgot.submit') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="email"> Email address </label>
						<input type="email" value="{{ old('email') }}" class="form-control" name="email" id="email" placeholder="Enter email">
					</div>
					<button type="submit" class="btn btn-primary"><i class="fa fa-unlock"> </i> Retrieve Password
					</button>
				</form>
				
				</div>
			</div>
		 
		</div>
		<div class="col-lg-3 col-md-3 col-sm-5"></div>
	</div>
	 
	<div style="clear:both"></div>
</div>
<div class="gap"></div>
@include ('front.includes.footer')