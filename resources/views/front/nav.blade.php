
    <div class="navbar navbar-tshop navbar-fixed-top megamenu" role="navigation">
        <div class="navbar-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6">
                        <div class="pull-left ">
                            <ul class="userMenu ">
                                <li>
                                    <a href="#"> <span class="hidden-xs">HELP</span><i class="glyphicon glyphicon-info-sign hide visible-xs "></i> </a>
                                </li>
                                <li class="phone-number">
                                    <a href="mailto:info@lifeforceglobal.com.au"> <span> <i class="glyphicon glyphicon-mail "></i></span> <span class="hidden-xs" style="margin-left:5px"> info@lifeforceglobal.com.au </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 no-margin no-padding">
                        <div class="pull-right">
                            <ul class="userMenu">
                                @if (!Auth::check())
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#ModalLogin"> <span class="hidden-xs">Sign In</span>
                                        <i class="glyphicon glyphicon-log-in hide visible-xs "></i> </a>
                                </li>
                                <li class="hidden-xs">
                                <a href="#" data-toggle="modal" data-target="#ModalSignup"> CreateAccount </a></li>
                                @else
                                    <li>
                                        <a href=""><span>Welcome: <strong>{{ Auth::user()->email }}</strong></span></a>
                                    </li>
                                     <li>
                                        <a href="{{ route('user.logout') }}">Logout</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span></button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-cart"><i class="fa fa-shopping-cart colorWhite"> </i> <span class="cartRespons colorWhite"> Cart ($210.00) </span></button>
                <a class="navbar-brand " href="{{ route('front.index') }}"> <img src="{{ url('images/logo.png') }}" alt=""> </a>

                <div class="search-box pull-right hidden-lg hidden-md hidden-sm">
                    <div class="input-group">
                        <button class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
                    </div>

                </div>
            </div>

            <div class="navbar-cart  collapse">
                <div class="cartMenu  col-lg-4 col-xs-12 col-md-4 ">
                    <?php $total = 0 ?>
                     @if ( count(Cart::content()) > 0)
                    <div class="w100 miniCartTable scroll-pane">
                        <table>
                            <tbody>
                                
                                @foreach (Cart::content() as $item)

                                <tr class="miniCartProduct">
                                    <td style="width:20%" class="miniCartProductThumb">
                                        <div>
                                            <a href="product-details.html"> <img src="images/product/3.jpg" alt="img"> </a>
                                        </div>
                                    </td>
                                    <td style="width:40%">
                                        <div class="miniCartDescription">
                                            <h4><a href="product-details.html"> {{ $item->product_name }} </a></h4>
                                            <div class="price"><span> {{ $item->price }} </span></div>
                                        </div>
                                    </td>
                                    <td style="width:10%" class="miniCartQuantity"><a> X {{ $item->qty }}</a></td>
                                    <td style="width:15%" class="miniCartSubtotal"><span> {{ $item->price * $item->qty }} </span></td>
                                    <td style="width:5%" class="delete"><a> x </a></td>
                                </tr>
                                <?php $total +=  $item->price * $item->qty ?>
                               @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="miniCartFooter  miniCartFooterInMobile text-right">
                        <h3 class="text-right subtotal"> Subtotal: {{ $total }} </h3>
                        <a class="btn btn-sm btn-danger" href="{{ route('front.cart.page') }}"> <i class="fa fa-shopping-cart"> </i> VIEW CART
                        </a> <a href="{{ route('front.cart.page') }}" class="btn btn-sm btn-primary"> CHECKOUT </a></div>
                    @else
                        <div class="w100 miniCartTable scroll-pane">
                        <p>Your cart is empty</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('front.index') }}"> Home </a></li>
                    <li class="dropdown megamenu-fullwidth">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Products <b class="caret"> </b> </a>
                        <ul class="dropdown-menu">
                            <li class="megamenu-content ">
                               
                                <ul class="col-lg-3  col-sm-3 col-md-3 unstyled noMarginLeft newCollectionUl">
                                     @foreach (Site::NavData() as $category )
                                    <li><a href="{{ route('front.category',$category->id) }}"> {{ $category->category_name }} </a></li>
                                    @endforeach
                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('front.aboutus') }}">About Us</a>
                    </li>
                     <li>
                        <a href="{{ route('front.contactus') }}">Contact Us</a>
                    </li>
                </ul>
      

                <div class="nav navbar-nav navbar-right hidden-xs">
                    <div class="dropdown  cartMenu ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-shopping-cart"> </i> <span class="cartRespons"> Cart (${{$total}}) </span> <b class="caret"> </b> </a>
                        <div class="dropdown-menu col-lg-4 col-xs-12 col-md-4 ">

                            @if ( count(Cart::content()) > 0)
                            <div class="w100 miniCartTable scroll-pane">
                                <table>
                                    <tbody>
                                         <?php $total = 0 ?>
                                         @foreach (Cart::content() as $item)

                                         <tr class="miniCartProduct">
                                            <td style="width:20%" class="miniCartProductThumb">
                                                <div>
                                                    <a href="{{ route('front.product',$item->id) }}"> <img src="images/product/3.jpg" alt="img">
                                                    </a>
                                                </div>
                                            </td>
                                            <td style="width:40%">
                                                <div class="miniCartDescription">
                                                    <h4><a href="{{ route('front.product',$item->id) }}"> {{ $item->product_name }} </a></h4>
                                                    <div class="price"><span> {{ $item->price }} </span></div>
                                                </div>
                                            </td>
                                            <td style="width:10%" class="miniCartQuantity"><a> X {{ $item->qty }}</a></td>
                                            <td style="width:15%" class="miniCartSubtotal"><span> {{ $item->price * $item->qty }} </span></td>
                                            <td style="width:5%" class="delete"><a> x </a></td>
                                        </tr>
                                        <?php $total +=  $item->price * $item->qty ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="miniCartFooter text-right">
                                <h3 class="text-right subtotal"> Subtotal: {{$total}} </h3>
                                <a class="btn btn-sm btn-danger" href="{{route('front.cart.page') }}"> <i class="fa fa-shopping-cart"> </i> VIEW CART </a><a class="btn btn-sm btn-primary"> CHECKOUT </a></div>
                            @else
                                <div class="w100 miniCartTable scroll-pane">
                               <p>Your cart is empty</p>
                               </div>
    
                            @endif
                        </div>

                    </div>

                    <div class="search-box">
                        <div class="input-group">
                            <button class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="search-full text-right">
            <a class="pull-right search-close"> <i class=" fa fa-times-circle"> </i> </a>
            <div class="searchInputBox pull-right">
                <input type="search" data-searchurl="search?=" name="q" placeholder="start typing and hit enter to search" class="search-input">
                <button class="btn-nobg search-btn" type="submit"><i class="fa fa-search"> </i></button>
            </div>
        </div>

    </div>
