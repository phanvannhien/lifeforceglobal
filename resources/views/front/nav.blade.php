
    <div class="navbar navbar-tshop" role="navigation">
        <div class="navbar-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-xs-6 col-md-6">
                        <div class="">
                            <a href="/">
                                <img src="{{ url('images/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-9 col-xs-6 col-md-6 no-margin no-padding">
                        <div class="">
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
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="{{ route('front.index') }}"> Home </a></li>
                                <li class="dropdown megamenu-fullwidth">
                                    <a href="{{ route('front.products') }}">Products</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.aboutus') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.contactus') }}">Contact Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.feedback') }}">Feedback Us</a>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="31" height="37" viewBox="215.5 322.7 164.9 196.4" preserveAspectRatio="xMinYMax meet" ng-switch-when="9">
                                        <path d="M362.5 519.2H232.8c-1.8 0-3-1.2-3-2.4L215.5 388.8c0-0.6 0-1.8 0.6-2.4 0.6-0.6 1.2-1.2 2.4-1.2h158.9c0.6 0 1.8 0.6 2.4 1.2 0.6 0.6 0.6 1.2 0.6 2.4l-14.9 127.4C365.5 518 364.3 519.2 362.5 519.2zM235.1 513.2h125l13.7-122H221.4L235.1 513.2z"></path>
                                        <path d="M334.5 388.8h-6v-27.4c0-17.9-13.7-32.7-31-32.7s-31 14.9-31 32.7V388.8h-6v-27.4c0-21.4 16.7-38.7 36.9-38.7s36.9 17.3 36.9 38.7V388.8z"></path>
                                        <text x="298" y="455" dy=".35em" text-anchor="middle" class="quantity" data-hook="cart-widget-items-count">0</text>
                                    </svg>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
