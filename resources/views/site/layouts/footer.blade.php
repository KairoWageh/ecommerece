<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <?php
                        use App\Setting;
                        $app = Setting::first();
                    ?>
                    @if(session('lang') == 'en')
                        <h2>{{ $app->sitename_en }}</h2>
                        <p>
                            {{ $app->description_en }}
                        </p>
                    @elseif(session('lang') == 'ar')
                        <h2>{{ $app->sitename_ar }}</h2>
                        <p>
                            {{ $app->description_ar }}
                        </p>
                    @endif

                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">User Navigation </h2>
                    <ul>
                        <li><a href="#">My account</a></li>
                        <li><a href="#">Order history</a></li>
                        <li><a href="#">Wishlist</a></li>
                        <li><a href="#">Vendor contact</a></li>
                        <li><a href="#">Front page</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">{{ __('user.departments') }}</h2>
                    <?php
                        use App\Department;
                        $departments = Department::all();
                    ?>
                    <ul>
                        @foreach($departments as $department)
                            @if(session('lang') == 'en')
                                <li><a href="#">{{ $department->department_name_en }}</a></li>
                            @elseif(session('lang') == 'ar')
                                <li><a href="#">{{ $department->department_name_ar }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="footer-newsletter">
                    <h2 class="footer-wid-title">Newsletter</h2>
                    <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to your inbox!</p>
                    <div class="newsletter-form">
                        <form action="#">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy; 2020
                        @if(session('lang') == 'en')
                            {{ $app->sitename_en }}
                        @elseif(session('lang') == 'ar')
                            {{ $app->sitename_ar }}
                        @endif. {{ __('user.all_rights_reserved') }} | {{ __('user.design_by') }}
                        <a href="https://www.linkedin.com/in/kairo-wageh-591811b5/" target="_blank">Kairo Wageh</a>
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->

<!-- Latest jQuery form server -->
<script src="{{ asset('public/design/site/js/jquery.min.js') }}"></script>

{{--<!-- Bootstrap JS form CDN -->--}}
{{--<script src="{{ asset('public/design/site/js/bootstrap.min.js') }}"></script>--}}

<!-- jQuery sticky menu -->
<script src="{{ asset('public/design/site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/design/site/js/jquery.sticky.js') }}"></script>

<!-- jQuery easing -->
<script src="{{ asset('public/design/site/js/jquery.easing.1.3.min.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('public/design/site/js/main.js') }}"></script>

<!-- Slider -->
<script type="text/javascript" src="{{ asset('public/design/site/js/bxslider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/design/site/js/script.slider.js') }}"></script>

<!-- Payment -->
<link rel="stylesheet" href="{{ asset('public/design/site/js/bluebird.min.js') }}">
<link rel="stylesheet" href="{{ asset('public/design/site/js/tap.min.js') }}">
@stack('js')
@stack('css')
</body>
</html>
