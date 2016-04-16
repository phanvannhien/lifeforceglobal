
@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
   <div class="row">
      <div class="breadcrumbDiv col-lg-12">
         <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li class="active"> Authentication</li>
         </ul>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12 col-md-12  col-sm-12">
         <h1 class="section-title-inner"><span><i class="fa fa-lock"></i> Authentication</span></h1>
         @if ( Session::has('message') )
			<div class="alert alert-danger">
				{{ Session::get('message') }}
			</div>
         @endif
         <div class="row userInfo">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
               <h2 class="block-title-2"><span>Already member?</span></h2>
               <form role="form" method="post" action="{{ route('home.login.post') }}">
               		<input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     <label for="InputEmail2">Email address</label>
                     <input type="email" name="email" class="form-control" id="" placeholder="Enter email" value="{{ old('email') }}">
                  </div>
                  <div class="form-group">
                     <label for="InputPassword2">Password</label>
                     <input type="password" class="form-control" id="" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                     <p><a title="Recover your forgotten password" href="{{ route('user.forgot') }}">Forgot your
                        password? </a>
                     </p>
                  </div>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Sign In</button>
               </form>
            </div>
           
         </div>
      </div>
   </div>
   <div style="clear:both"></div>
</div>
<div class="gap"></div>
@include ('front.includes.footer')