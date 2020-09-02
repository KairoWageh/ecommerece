<!DOCTYPE HTML>
<html lang="zxx">
	<head>
		<title>{{__('user.login')}}</title>
		<!-- Meta tag Keywords -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8" />
		<meta name="keywords" content="" />
		<script>
			addEventListener("load", function () {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- Meta tag Keywords -->
		<!-- css files -->
		<link href="{{asset('public/design/site/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
		<link rel="stylesheet" href="{{ asset('public/design/site/css/login-style.css') }}" type="text/css" media="all" />
		<link href="{{asset('public/design/site/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">

	    @if(app()->getLocale() == 'ar')
	    	<link href="{{asset('public/design/site/css/bootstrap-rtl.css') }}" rel="stylesheet" type="text/css" media="all">   
	    @endif
		<!-- Style-CSS -->
		<link rel="stylesheet" href="{{ asset('public/design/site/css/font-awesome.min.css') }}" type="text/css" media="all" >
		<!-- Font-Awesome-Icons-CSS -->
		<!-- //css files -->
		<!-- web-fonts -->
		<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
		 rel="stylesheet">
		<!-- //web-fonts -->

		

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
			  color: #fff;
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
		<div class="main-bg">
			<header id="header" class="fixed-top ">
			    <div class="container d-flex align-items-center">
			      <nav class="nav-menu d-none d-lg-block">
			        <ul style="float: left;">
			          <li>
			            <div class="dropdown">
			              <span>{{__('user.language')}}</span>
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
		  	@yield('content')

		  	<!-- copyright -->
			<div class="copyright">
				<h2>&copy; 2020. All rights reserved | Design by
					<a href="https://www.linkedin.com/in/kairo-wageh-591811b5/" target="_blank">Kairo Wageh</a>
				</h2>
			</div>
			<!-- //copyright -->
		</div>
	</body>
</html>