@include ('front.includes.header')
@include ('front.nav')
<?php $total = 0 ?>
@foreach($cart as $item)
    <?php $total += $item->price * $item->qty ?>
@endforeach
<div class="container main-container headerOffset">
    <div class="row">
        <div class="breadcrumbDiv col-lg-12">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Cart</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-6 col-xxs-12 text-center-xs">
            <h1 class="section-title-inner"><span><i class="glyphicon glyphicon-shopping-cart"></i> Checkout </span></h1>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar col-xs-6 col-xxs-12 text-center-xs">
            <h4 class="caps"><a href="javascript:void(0)" onclick="window.history.back()"><i class="fa fa-chevron-left"></i> Back to shopping </a></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-7">
            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    @if(count($cart))
                        <form action="{{ route('front.checkout.guest.post') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="cartContent w100">
                                <div class="row userInfo">
                                    <div class="col-lg-12">
                                        <h2 class="block-title-2"> To add a shipping address, please fill out the form
                                            below. </h2>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group required">
                                            <label for="InputName">Your Name <sup>*</sup> </label>
                                            <input name="fullname" required="" type="text" class="form-control" id="" placeholder="Your Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="InputEmail">Email </label>
                                            <input name="email" type="text" class="form-control" id="" placeholder="Email">
                                        </div>
                                        <div class="form-group required">
                                            <label for="InputMobile">Mobile phone <sup>*</sup></label>
                                            <input required="" type="tel" name="InputMobile" class="form-control" id="InputMobile">
                                        </div>

                                        <div class="form-group">
                                            <label for="InputAdditionalInformation">Additional information</label>
                                            <textarea rows="3" cols="26" name="InputAdditionalInformation" class="form-control" id="other"></textarea>
                                        </div>


                                    </div>
                                    <div class="col-xs-12 col-sm-6">

                                        <div class="form-group required">
                                            <label for="InputCountry">Country <sup>*</sup> </label>
                                            <select class="form-control select2-hidden-accessible" required="" aria-required="true" id="InputCountry" name="InputCountry" tabindex="-1" aria-hidden="true">
                                                <option value="">Choose</option>
                                                <option value="38">Algeria</option>

                                            </select>
                                        </div>
                                        <div class="form-group required">
                                            <label for="InputZip">Zip / Postal Code <sup>*</sup> </label>
                                            <input required="" type="text" class="form-control" id="InputZip" placeholder="Zip / Postal Code">
                                        </div>



                                        <div class="form-group required">
                                            <label for="InputCity">City <sup>*</sup> </label>
                                            <input required="" type="text" class="form-control" id="InputCity" placeholder="City">
                                        </div>
                                        <div class="form-group required">
                                            <label for="InputState">State <sup>*</sup> </label>
                                            <select class="form-control select2-hidden-accessible" required="" aria-required="true" id="InputState" name="InputState" tabindex="-1" aria-hidden="true">
                                                <option value="">Choose</option>
                                                <option value="1">Alabama</option>
                                                <option value="2">Alaska</option>

                                            </select>
                                        </div>

                                        <div class="form-group required">
                                            <label for="InputAddress">Address <sup>*</sup> </label>
                                            <input required="" type="text" class="form-control" id="InputAddress" placeholder="Address">
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit Checkout</button>
                        </form>
                    @else
                        <p>Your cart is empty!</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-5 rightSidebar">
            <div class="contentBox">
                <div class="w100 costDetails">
                    <div class="table-block" id="order-detail-content">
                        <div class="w100 cartMiniTable">

                            <table id="cart-summary" class="std table">
                                <tbody>
                                <tr>
                                    <td>Total products</td>
                                    <td class="price">{{ $total }}</td>
                                </tr>
                                <tr style="">

                                    <td class="price" colspan="2"><span class="success">Shipping 10$ in Australia</span></td>
                                </tr>

                                <tr>
                                    <td> Total</td>
                                    <td class=" site-color" id="total-price">{{ $total + 10 }}</td>
                                </tr>
                                <!--
                                <tr>
                                   <td colspan="2">
                                      <div class="input-append couponForm">
                                         <input class="col-lg-8" id="appendedInputButton" type="text" placeholder="Coupon code">
                                         <button class="col-lg-4 btn btn-success" type="button">Apply!</button>
                                      </div>
                                   </td>
                                </tr>
                                -->
                                </tbody>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
</div>
<div class="gap"></div>
</div>

@include ('front.includes.footer')