
    <div class="navbar navbar-tshop" role="navigation">
        <div class="navbar-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2 col-sm-3 col-xs-3 ">
                        <div class="">
                            <a href="/">
                                <img class="img-fluid" src="{{ url('images/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-10 col-sm-9 col-xs-9  no-margin no-padding">

                        <p class="text-xs-right user-menu-top">
                                @if (!Auth::check())
                                    <a href="#" data-toggle="modal" data-target="#ModalLogin">
                                        <span class="hidden-xs">Login</span>
                                    </a>/
                                    <a href="#" data-toggle="modal" data-target="#ModalSignup">Sign up</a>
                                @else
                                    <a href=""><span>Welcome: <strong>{{ Auth::user()->email }}</strong></span></a>
                                    <a href="{{ route('user.dashboard') }}">My Account</a> / <a href="{{ route('user.logout') }}">Logout</a>
                                @endif
                            </p>
                        <button  class="navbar-toggler hidden-md-up pull-xs-right js-toggle-left-slidebar" type="button">
                            &#9776;
                        </button>

                        <div class="hidden-sm-down" id="">
                            
                            <ul class="nav navbar-nav">
                                <li class="active nav-item"><a href="{{ route('front.index') }}"> Home </a></li>
                                <li class="nav-item">
                                    <a href="{{ route('front.products') }}">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('front.aboutus') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.contactus') }}">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                                <li class="mini-cart-button">
                                    <a href="#" class="js-toggle-right-slidebar">
                                       
                                        <i class="fa fa-shopping-cart fa-lg "></i>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
