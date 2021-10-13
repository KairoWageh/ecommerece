<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{__('login')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/design/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('public/design/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/design/admin/dist/css/adminlte.min.css')}}">
    @if(app()->getLocale() == 'ar')
        <link href="{{asset('public/design/admin/css/bootstrap-rtl.css')}}" rel="stylesheet" type="text/css" media="all">
        <link href="{{asset('public/design/admin/css/style-ar.css')}}" rel="stylesheet" type="text/css" media="all">
    @endif
</head>
<body class="hold-transition login-page">
	<header id="header" class="fixed-top ">
	    <div class="container d-flex align-items-center">
	      <nav class="nav-menu d-none d-lg-block">
              <!-- Language -->
              <ul class='nav'>
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{__('language')}}</a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                            <li>
                                <a href="{{ url('lang/en') }}"> English </a>
                            </li>
                            <li>
                                <a href="{{ url('lang/ar') }}"> العربية</a>
                            </li>
                        </ul>
                    </div>
                </li>
              </ul>
	      </nav><!-- .nav-menu -->
	    </div>
    </header><!-- End Header -->
{{--    <div class="login-page">--}}
{{--	    <div class="login-main">--}}
	    	@if(session()->has('success'))
				<div class="alert alert-success">
					<h4>{{ session()->get('success') }}</h4>
				</div>
			@endif

			@if(session()->has('error'))
				<div class="alert alert-danger">
					<h4>
						{{ session()->get('error') }}
					</h4>
				</div>
			@endif
	    	@if(count($errors->all()) > 0)
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</div>
			@endif

			@yield('content')
{{--		</div>--}}
{{--	</div>--}}
	<!--inner block end here-->
	<!--copy rights start here-->
    <!-- jQuery -->
    <script src="{{asset('public/design/admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('public/design/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/design/admin/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
