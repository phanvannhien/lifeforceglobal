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
                                       <label class="radio inline">
                                       <input id="exisitingAddress" type="radio" value="current_address" checked="" name="add"> Use my existing address
                                       </label>&nbsp;&nbsp;
                                       <label class="radio inline">
                                       <input id="newAddress" type="radio" value="new_address" name="add"> I want to assign new address
                                       </label>
                                       <hr>
                                       <div style="clear: both"></div>
                                       <div id="exisitingAddressBox" class="collapse in">
                                          <div class="form-group required maxwidth300">
                                             <label for="InputCountry">Select Address <sup>*</sup></label>
                                             <select class="form-control" required aria-required="true" id="SelectAddress" name="SelectAddress">
                                                <option value="-1">Select your address</option>
                                                @foreach ( CustomerHelper::getAddressBook() as $address )
                                                   <option value="{{ $address->address }}">{{ $address->address }}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <button type="submit" class="btn btn-primary">Submit Checkout</button>
                                          </div>
                                       </div>
                                      
                             
                                       <div id="newBillingAddressBox" class="collapse">
                                         
                                          <div class="form-group required">
                                             <label for="InputName">Address <sup>*</sup> </label>
                                             <input type="text" class="form-control" id="" name="address" placeholder="Address">
                                          </div>
                                          <div class="form-group">
                                             <button type="submit" class="btn btn-primary">Submit Checkout</button>
                                          </div>
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
                 
                  <tr>
                     <td>Total tax</td>
                     <td class="price" id="total-tax">{{ PriceHelper::formatPrice(Cart::total()*0.1) }}</td>
                  </tr>
                  <tr>
                     <td> Total</td>
                     <td class=" site-color" id="total-price">{{ PriceHelper::formatPrice(Cart::total()*1.1) }}</td>
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