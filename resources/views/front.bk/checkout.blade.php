@include ('front.includes.header')
@include ('front.nav')

<div class="container main-container headerOffset">
   <div class="row">
      <div class="breadcrumbDiv col-lg-12">
         <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="active"> Checkout</li>
         </ul>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs">
         <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> Checkout</span></h1>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-12">
         <div class="row userInfo">
            <div class="col-xs-12 col-sm-12">
               <div class="w100 clearfix">
                  <div class="row userInfo">
                     <div style="clear: both"></div>
                     <div class="onepage-checkout col-lg-12">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                           
                           <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                 <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#BillingInformation" aria-expanded="true" aria-controls="BillingInformation">
                                    Shipping information
                                    </a>
                                 </h4>
                              </div>
                              <div id="BillingInformation" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="BillingInformation">
                                 <div class="panel-body">
                                   
                                    <form class="form" action="{{ route('front.checkout.final') }}" method="post" >
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       @if (Auth::check())
                                       <input type="hidden" name="checkout_type" value="member_checkout">
                                       <label class="radio inline">
                                       <input id="exisitingAddress" type="radio" value="current_address" checked="" name="add"> Use my existing address
                                       </label>&nbsp;&nbsp;
                                       <label class="radio inline">
                                       <input id="newAddress" type="radio" value="new_address" name="add"> I want to assign new address
                                       </label>
                                       <hr>
                                       <div style="clear: both"></div>
                                       <div id="exisitingAddressBox" class="collapse in">
                                          <div class="form-group required">
                                             <label for="InputCountry">Select Address <sup>*</sup></label>
                                             <select class="form-control" id="SelectAddress" name="SelectAddress">
                                                @foreach ( CustomerHelper::getAddressBook(Auth::user()->id) as $address )
                                                   <option value="{{ $address->id }}">{{ $address->address.', '.$address->suburb.', '.$address->postalcode.' '.$address->cityname.', '.$address->country  }}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                          
                                       </div>
                                       <div id="newBillingAddressBox" class="collapse">
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
                                                       <option value="{{$city->cityName}}">{{ $city->cityName }} ({{ $city->externalCode }})</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                              
                                              <div class="form-group required">
                                                  <label for="InputCity">Suburb <sup>*</sup> </label>
                                                  <input name="suburb" type="text" class="form-control" id="" placeholder="Sydney">
                                                 
                                              </div>

                                              <div class="form-group required">
                                                  <label for="">Zip / Postal Code <sup>*</sup> </label>
                                                  <input name="postalcode" type="text" class="form-control" id="" placeholder="00002">
                                              </div>

                                              <div class="form-group required">
                                                  <label for="">Address <sup>*</sup> </label>
                                                  <input name="address" type="text" class="form-control" id="" placeholder="14/476 Illawarra rd ">
                                              </div>
                                          
                                       </div>
                                       @else
                                          <input type="hidden" name="checkout_type" value="guest_checkout">
                                          <div class="col-xs-12 col-sm-6">
                                              <div class="form-group required">
                                                  <label for="">Your Name <sup>*</sup> </label>
                                                  <input name="fullname" required="" type="text" class="form-control" id="" placeholder="Your Name">
                                              </div>

                                              <div class="form-group required">
                                                  <label for="">Email <sup>*</sup></label>
                                                  <input required name="email" type="text" class="form-control" id="" placeholder="Email">
                                              </div>
                                              <div class="form-group required">
                                                  <label for="">Mobile phone <sup>*</sup></label>
                                                  <input required type="tel" name="phone" class="form-control" id="">
                                              </div>

                                              <div class="form-group">
                                                  <label for="">Additional information</label>
                                                  <textarea name="additional_infomation" rows="3" cols="26" name="info" class="form-control" id=""></textarea>
                                              </div>


                                          </div>
                                          <div class="col-xs-12 col-sm-6">

                                              <div class="form-group required">
                                                  <label for="">Country <sup>*</sup> </label>
                                                  <select class="form-control" required="" aria-required="true" id="" name="country" >
                                                      <option value="AU">Australia</option>
                                                  </select>
                                              </div>

                                              <div class="form-group required">
                                                  <label for="InputState">State <sup>*</sup> </label>
                                                  <select class="form-control" required="" aria-required="true" id="" name="city">
                                                      @foreach( \App\Models\City::all() as $city)
                                                       <option value="{{$city->cityName}}">{{ $city->cityName }} ({{ $city->externalCode }})</option>
                                                      @endforeach
                                                  </select>
                                              </div>
                                              
                                              <div class="form-group required">
                                                  <label for="InputCity">Suburb <sup>*</sup> </label>
                                                  <input name="suburb" required="" type="text" class="form-control" id="" placeholder="Sydney">
                                                 
                                              </div>

                                              <div class="form-group required">
                                                  <label for="">Zip / Postal Code <sup>*</sup> </label>
                                                  <input name="postalcode" required="" type="text" class="form-control" id="" placeholder="00002">
                                              </div>

                                              <div class="form-group required">
                                                  <label for="">Address <sup>*</sup> </label>
                                                  <input name="address" required="" type="text" class="form-control" id="" placeholder="14/476 Illawarra rd ">
                                              </div>

                                          </div>
                                          
                                       @endif
                                       <div class="form-group">
                                          <button type="submit" class="btn btn-primary">Submit Checkout</button>
                                       </div>
                                    </form>
                                    
                                 </div>
                              </div>
                           </div>
                          
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 rightSidebar">
         <div class="w100 cartMiniTable">
            <table id="cart-summary" class="std table">
               <tbody>
                  <tr>
                     <td>Total products</td>
                     <td class="price">{{ PriceHelper::formatPrice(Cart::total()) }}</td>
                  </tr>
                  <tr style="">
                     <td class="price" colspan="2"><span class="success">Shipping 10$ in Australia</span></td>
                  </tr>
                  <tr>
                     <td> Total</td>
                     <td class=" site-color" id="total-price">{{ PriceHelper::formatPrice(Cart::total()+ 10) }}</td>
                  </tr>
               </tbody>
               <tbody>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div style="clear:both"></div>
</div>
<div class="gap"></div>

@include ('front.includes.footer')

<script>


    $(document).ready(function () {

        $('input#newAddress').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#newBillingAddressBox').collapse("show");
            $('#exisitingAddressBox').collapse("hide");

        });

        $('input#exisitingAddress').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#newBillingAddressBox').collapse("hide");
            $('#exisitingAddressBox').collapse("show");
        });
   });     
</script>