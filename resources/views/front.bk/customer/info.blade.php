@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
   <div class="row">
      <div class="breadcrumbDiv col-lg-12">
         <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active"> My information</li>
         </ul>
      </div>
   </div>

   @include('front.partials.message')
   <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-7">
         <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-user"></i> My personal information </span></h1>
         <div class="row userInfo">
            <div class="col-lg-12">
               <h2 class="block-title-2"> Please be sure to update your personal information if it has
                  changed. 
               </h2>
               <p class="required"><sup>*</sup> Required field</p>
               <p> <strong> Your code: </strong> <label for="" class="label label-success">{{ $user->user_code }}</label> </p>
               <p> <strong> Email: </strong>{{ $user->email }}</p>
               <p> <strong> Register Date: </strong>{{ $user->registration_date }}</p>
               <p> <strong> Status: </strong><span class="label label-info"><?php echo ($user->user_status) ? 'active' :'disabled' ?></span> </p>
            </div>
            <form method="post" action="{{ route('user.info.post') }}">
               <input type="hidden" value="{{ csrf_token() }}" name="_token">
               <div class="col-xs-12 col-sm-6">
                  <div class="form-group required">
                     <label for="InputName">Your Name <sup>*</sup> </label>
                     <input type="text" class="form-control" id="" placeholder="Your Name" name="name" value="{{ $user->name }}">
                  </div>
         
                  <div class="form-group required">
                     <label for="InputPasswordCurrent"> Old Password <sup> * </sup> </label>
                     <input type="password" name="InputPasswordCurrent" class="form-control" id="InputPasswordCurrent" placeholder="******">
                  </div>
                  <div class="form-group required">
                     <label for="InputPasswordnew"> New Password </label>
                     <input type="password" name="InputPasswordnew" class="form-control" id="InputPasswordnew" placeholder="******">
                  </div>
                  <div class="form-group required">
                     <label for="InputPasswordnewConfirm"> Confirm Password </label>
                     <input type="password" name="InputPasswordnewConfirm" class="form-control" id="InputPasswordnewConfirm" placeholder="******">
                  </div>
               </div>
               
               <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp; Save</button>
               </div>
            </form>
            <div class="col-lg-12 clearfix">
               <ul class="pager">
                  <li class="previous pull-right"><a href="/"> <i class="fa fa-home"></i> Go to Shop </a></li>
                  <li class="next pull-left"><a href="{{ route('user.dashboard') }}"> &larr; Back to My Account</a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-5"></div>
   </div>
   <div style="clear:both"></div>
</div>
<div class="gap"></div>

@include ('front.includes.footer')