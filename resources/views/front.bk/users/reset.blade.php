
@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
	<div class="row">
		<div class="breadcrumbDiv col-lg-12">
			<ul class="breadcrumb">
			<li><a href="/"> Home </a></li>
			<li class="active"> Reset your password</li>
			</ul>
		</div>
	</div>
	
	<div class="row">
	
		<div class="col-lg-9 col-md-9 col-sm-7">
		@include('front.partials.message')
			<h1 class="section-title-inner"><span> <i class="fa fa-unlock-alt"> </i> Reset your password? </span></h1>
			<div class="row userInfo">
				<div class="col-xs-12 col-sm-12">
				
			        <form id="reset-password" class="form-horizontal" role="form" method="POST" action="{{ route('user.postresetpassword') }}">
			        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">
			        	<div class="form-group">
			        		<label class="col-md-4 control-label">E-Mail</label>
			        		<div class="col-md-8">
			        			<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			        		</div>
			        	</div>

			        	<div class="form-group">
			        		<label class="col-md-4 control-label">New Password</label>
			        		<div class="col-md-8">
			        			<input type="password" class="form-control" name="password">
			        		</div>
			        	</div>

			        	<div class="form-group">
			        		<label class="col-md-4 control-label">Confirm New Password</label>
			        		<div class="col-md-8">
			        			<input type="password" class="form-control" name="password_confirmation">
			        		</div>
			        	</div>

			        	<div class="form-group">
			        		<div class="col-md-8 col-md-offset-4">
			        			<button type="submit" class="btn btn-primary">
			        				<i class="fa fa-send"></i>
			        				Submit
			        			</button>
			        		</div>
			        	</div>
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