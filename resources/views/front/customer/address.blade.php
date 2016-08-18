@include ('front.includes.header')
@include ('front.nav')
<div class="container main-container headerOffset">
  
   <div class="row">
      <div class="col-sm-12">
         <h2 class="section-title-inner"><span><i class="fa fa-map-marker"></i> My addresses </span></h2>

         <p>&nbsp;</p>
         <div class="row userInfo">
            <div class="col-lg-12">
               <p> Be sure to update your personal information if it has changed.</p>
            </div>
             <div class="col-lg-12">
                 @include ('front.partials.message')
                <form class="form" action="{{ route('user.address.add') }}" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <?php
                     $dataEdit['city'] = old('city');
                     $dataEdit['suburb'] = old('suburb');
                     $dataEdit['postalcode'] = old('postalcode');
                     $dataEdit['address'] = old('address');
                  ?>
                  @if( isset($address_edit) )
                     <?php
                        $dataEdit['city'] = $address_edit->cityname;
                        $dataEdit['suburb'] = $address_edit->suburb;
                        $dataEdit['postalcode'] = $address_edit->postalcode;
                        $dataEdit['address'] = $address_edit->address;
                     ?>
                     <input type="hidden" name="mode_edit" value="1">
                     <input type="hidden" name="id" value="{{ $address_edit->id }}">
                  @endif
                   <div class="form-group required">
                        <label for="">Country <sup>*</sup> </label>
                        <select class="form-control" id="" name="country" >
                            <option value="AU">Australia</option>
                        </select>
                    </div>

                    <div class="form-group required">
                        <label for="InputState">State <sup>*</sup> </label>
                        <select class="form-control" id="" name="city">
                            @foreach( \App\Models\City::all() as $city)
                              @if( $city->cityName == $dataEdit['city'] )
                              <option selected="" value="{{$city->cityName}}">{{ $city->cityName }} ({{ $city->externalCode }})</option>
                              @else
                              <option value="{{$city->cityName}}">{{ $city->cityName }} ({{ $city->externalCode }})</option>
                              @endif
                             
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group required">
                        <label for="InputCity">Suburb <sup>*</sup> </label>
                        <input value="{{ $dataEdit['suburb'] }}" name="suburb" type="text" class="form-control" id="" placeholder="Sydney">
                       
                    </div>

                    <div class="form-group required">
                        <label for="">Zip / Postal Code <sup>*</sup> </label>
                        <input value="{{ $dataEdit['postalcode'] }}" name="postalcode" type="text" class="form-control" id="" placeholder="00002">
                    </div>

                    <div class="form-group required">
                        <label for="">Address <sup>*</sup> </label>
                        <input value="{{ $dataEdit['address'] }}" name="address" type="text" class="form-control" id="" placeholder="14/476 Illawarra rd ">
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