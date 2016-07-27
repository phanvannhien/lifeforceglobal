@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
   <div class="row">
      <div class="breadcrumbDiv col-lg-12">
         <ul class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active"> My Address</li>
         </ul>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
         <h1 class="section-title-inner"><span><i class="fa fa-map-marker"></i> My addresses </span></h1>
         @include ('front.partials.message')
         <div class="row userInfo">
            <div class="col-lg-12">
               <h2 class="block-title-2"> Your addresses are listed below. </h2>
               <p> Be sure to update your personal information if it has changed.</p>
            </div>
             <div class="col-lg-12">
                <form class="form" action="{{ route('user.address.add') }}" method="post">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                     <label for="">Address</label>
                     @if( isset($address_edit) )
                        <input type="hidden" name="mode_edit" value="1">
                        <input type="hidden" name="id" value="{{ $address_edit->id }}">
                        <input type="text" name="address" class="form-control" value="{{ $address_edit->address }}">
                     @else
                        <input type="text" name="address" class="form-control" value="">   
                     @endif
                     
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Save Address </button>
                  </div>
                </form>
             </div>
            <div class="col-lg-12">
            <div class="w100 clearfix">
               <table class="table table-striped">
                  <thead>
                     <tr><td>Address</td><td>Function</td></tr>
                  </thead>
                  <tbody>
                     @if ( count($address) > 0 )
                     @foreach( $address as $item ) 

                     <tr>
                        <td>{{ $item->address }}</td>
                        <td>
                           <a href="{{ route('user.address.edit',$item->id) }}" class="btn btn-sm btn-success"> <i class="fa fa-edit"> </i> Edit </a> 
                           <a href="{{ route('user.address.remove',$item->id) }}" class="btn btn-sm btn-danger"> <i class="fa fa-minus-circle"></i> Delete </a></div>
                        </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="2">You don't have address</td>
                     </tr>
                     @endif
                  </tbody>
               </table>
              
            </div>
            </div>
           
            <div class="col-lg-12 clearfix">
               <ul class="pager">
                  <li class="previous pull-right"><a href="/"> <i class="fa fa-home"></i> Go to Shop </a></li>
                  <li class="next pull-left"><a href="{{ route('user.dashboard') }}">&larr; Back to My Account</a></li>
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