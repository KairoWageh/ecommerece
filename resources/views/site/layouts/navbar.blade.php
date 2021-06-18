<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        @auth
                            <li><a href="{{ route('account') }}"><i class="fa fa-user"></i> {{__('user.my_account')}}</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> {{__('user.wishlist')}}</a></li>
                            <li><a href="{{ url('/cart') }}"><i class="fa fa-user"></i> {{__('user.my_cart')}}</a></li>
                            <li><a href="{{ route('cart.checkOut') }}"><i class="fa fa-user"></i> {{__('user.checkout')}}</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> {{ __('user.logout') }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> {{__('user.login')}}</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        @auth
                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                        @endauth

                        <li class="dropdown dropdown-small">
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">{{__('user.language')}} </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('lang', 'en') }}">English</a></li>
                                <li><a href="{{ route('lang', 'ar') }}">العربية</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img height="50px" width="50px" src="{{ Storage::url(setting()->logo) }}"></a></h1>
                </div>
            </div>
            
            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="{{ route('cart') }}">{{ __('user.cart') }} - <span class="cart-amunt">$100</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                </div>
            </div>
        </div>
    </div>
    </div> <!-- End site branding area -->