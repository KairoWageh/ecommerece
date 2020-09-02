<!DOCTYPE HTML>
<html>
	<head>
		<title>{{__('admin.login')}}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<link href="{{asset('public/design/adminpanel/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">

	    @if(app()->getLocale() == 'ar')
	    	<link href="{{asset('public/design/adminpanel/css/bootstrap-rtl.css') }}" rel="stylesheet" type="text/css" media="all">   
	    @endif

		<!-- Custom Theme files -->
		<link href="{{asset('public/design/adminpanel/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
		<!--js-->
		<script src="{{asset('public/design/adminpanel/js/jquery-2.1.1.min.js')}}"></script> 
		<!--icons-css-->
		<link href="{{asset('public/design/adminpanel/css/font-awesome.css')}}" rel="stylesheet"> 
		<!--Google Fonts-->
		<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
		<!--static chart-->
		<style type="text/css">
			.nav-menu ul {
			    margin: 0;
			    padding: 0;
			    list-style: none;
			}

			.nav-menu > ul {
			    display: flex;
			}

			.nav-menu > ul > li {
			    position: relative;
			    white-space: nowrap;
			    padding: 10px 0 10px 25px;
			}

			.nav-menu a {
			  display: block;
			  /*position: relative;
			  color: #fff;*/
			  transition: 0.3s;
			  font-size: 15px;
			  padding: 0 4px;
			  letter-spacing: 0.4px;
			  font-family: "Poppins", sans-serif;
			}
			/*--------------------------------------------------------------
			# Language dropdown
			--------------------------------------------------------------*/
			.dropdown {
			  position: relative;
			  display: inline-block;
			}

			.dropdown span{
			  color: #337ab7;
			}

			.dropdown-content {
			  display: none;
			  position: absolute;
			  right: 0;
			  background-color: #f9f9f9;
			  min-width: 160px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			}

			.dropdown-content a {
			  color: #66560e !important;
			  /*padding: 12px 16px;*/
			  text-decoration: none;
			  /*display: block;*/
			}

			.dropdown-content a:hover {
			  color: #fff !important;
			  background-color: #66560e;
			  text-decoration: none;
			}
			.dropdown:hover .dropdown-content {display: block;}
			.dropdown:hover .dropbtn {background-color: #3e8e41;}
		</style>
	</head>
	<body>	

	<header id="header" class="fixed-top ">
	    <div class="container d-flex align-items-center">
	      <nav class="nav-menu d-none d-lg-block">
	        <ul style="float: left;">
	          <li>
	            <div class="dropdown">
	              <span>{{__('admin.language')}}</span>
	              <div class="dropdown-content" style="left:0;">
	                <ul>
	                  <li>
	                    <a href="lang/en"> English </a>
	                  </li>
	                  <li>
	                    <a href="lang/ar"> العربية</a>
	                  </li>
	                </ul>
	              </div>
	            </div>
	          </li>
	        </ul>
	      </nav><!-- .nav-menu -->
	    </div>
	  </header><!-- End Header -->
	<div class="login-page">
	    <div class="login-main"> 

	    	@if(session('error'))
	    		<div class="alert alert-danger">
		    		{!! session('error') !!}
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
		</div>
	</div>
	<!--inner block end here-->
	<!--copy rights start here-->
	<div class="copyrights">
		<p>&copy; 2020. All rights reserved | Design by
			<a href="https://www.linkedin.com/in/kairo-wageh-591811b5/" target="_blank">Kairo Wageh</a>
		 </p>
	</div>	
	<!--COPY rights end here-->

	<!--scrolling js-->
	<script src="{{asset('public/design/adminpanel/js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('public/design/adminpanel/js/scripts.js')}}"></script>
	<!--//scrolling js-->
	<script src="{{asset('public/design/adminpanel/js/bootstrap.js')}}"> </script>
	<!-- mother grid end here-->
	</body>
</html>
