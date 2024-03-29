<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <?php
                $directoryURI = $_SERVER['REQUEST_URI'];
                $path = parse_url($directoryURI, PHP_URL_PATH);
                $components = explode('/', $path);
                $first_part = $components[2];
            ?>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php if ($first_part=="") {echo "active"; }?>"><a href="{{ url('/') }}">{{__('home')}}</a></li>
                    <li class="<?php if ($first_part=="shop") {echo "active"; }?>"><a href="{{ route('shop') }}">{{ __('shop') }}</a></li>

                    <li class="<?php if ($first_part=="cart") {echo "active"; }?>">
                        <a href="{{ url('/cart') }}" >{{__('cart')}}</a>
                    </li>
                    <!-- <li class="<?php if ($first_part=="cart") {echo "active"; }?>"><a href="{{ route('cart.checkOut') }}">Checkout</a></li> -->
                    <li class="<?php if ($first_part=="departments") {echo "active"; }?>"><a href="{{ route('user.departments') }}">{{__('departments')}}</a></li>
                    <li><a href="#">Others</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
