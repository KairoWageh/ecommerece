<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    .dropdown-content li{list-style: none}
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    .dropdown-content a:hover {background-color: #ddd;}

    .dropdown:hover .dropdown-content {display: block;}

</style>
<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        @auth
                            <li><a href="{{ route('account') }}"><i class="fa fa-user"></i> {{__('my_account')}}</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> {{__('wishlist')}}</a></li>
                            <li><a href="{{ url('/cart') }}"><i class="fa fa-user"></i> {{__('my_cart')}}</a></li>
                            <li><a href="{{ route('cart.checkOut') }}"><i class="fa fa-user"></i> {{__('checkout')}}</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> {{ __('logout') }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> {{__('login')}}</a></li>
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
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropbtn" href="#">
                                <span class="key">{{__('language')}} </span><b class="caret"></b>
                            </a>
                            <ul class="dropdown-content">
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
                    <a href="{{ route('cart') }}">{{ __('cart') }} - <span class="cart-amunt">$100</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                </div>
            </div>
        </div>
    </div>
    </div> <!-- End site branding area -->
