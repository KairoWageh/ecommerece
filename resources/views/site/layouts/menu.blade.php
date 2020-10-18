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
                    <li class="<?php if ($first_part=="") {echo "active"; }?>"><a href="{{ url('/') }}">{{__('user.home')}}</a></li>
                    <li><a href="shop.html">Shop page</a></li>

                    <li class="<?php if ($first_part=="cart") {echo "active"; }?>">
                        <a href="{{ url('/cart') }}" >{{__('user.cart')}}</a>
                    </li>
                    <li><a href="checkout.html">Checkout</a></li>
                    <li class="<?php if ($first_part=="departments") {echo "active"; }?>"><a href="{{ route('user.departments') }}">{{__('user.departments')}}</a></li>
                    <li><a href="#">Others</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>  
        </div>
    </div>
    </div> <!-- End mainmenu area -->
