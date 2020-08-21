<!DOCTYPE HTML>
<html>
<head>
<title>{{__('admin.resetPassword')}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="{{asset('public/design/adminpanel/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
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
</head>
<body>	
<div class="login-page">
    <div class="login-main"> 
    	@if(session()->has('success'))
			<div class="alert alert-success">
				<h5>{{session('success')}}</h5>
			</div>
		@endif 	
    	<div class="login-head">
			<h1>Reset password</h1>
		</div>
		<div class="login-block">
			<form method="post">
				{!! csrf_field() !!}
				<input type="text" name="email" placeholder="Email" required="">
				<input type="submit" name="Reset" value="Reset">	
			</form>
			<h5><a href="{{url(adminuRL('login'))}}">Sign in</a></h5>
		</div>
      </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->
<div class="copyrights">
	 <p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
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


                      
						
