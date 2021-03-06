<!DOCTYPE HTML>
<html>
<head>
	<title>{{!empty($title)?$title:__('adminpanel')}}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<link href="{{asset('public/design/adminpanel/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
	<!-- Custom Theme files -->
	<link href="{{asset('public/design/adminpanel/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
	@if(direction() == 'rtl')
	<link rel="stylesheet" href="{{ asset('public/design/site/css/bootstrap-rtl.css') }}">
	<link href="{{asset('public/design/adminpanel/css/style-ar.css')}}" rel="stylesheet" type="text/css" media="all"/>
	@endif

	<!-- select2 -->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/design/adminpanel/css/select2.min.css') }}">

	<!-- datepicker -->
	<link rel="stylesheet" type="text/css" href="{{asset('public/design/adminpanel/css/bootstrap-datepicker.min.css')}}">
	<!--//datepicker -->
	<!--js-->
	<script src="{{asset('public/design/adminpanel/js/jquery-2.1.1.min.js')}}"></script>
    <script src="{{asset('public/design/adminpanel/js/bootstrap.js')}}"></script>
	<!--icons-css-->
	<link href="{{asset('public/design/adminpanel/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('public/design/adminpanel/css/toastr.min.css') }}">
	<!--Google Fonts-->
	<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{asset('public/design\adminpanel\jstree\themes\default\style.css')}}" />
	<!--static chart-->
	<script src="{{asset('public/design/adminpanel/js/Chart.min.js')}}"></script>
	<!--//charts-->
	<!-- geo chart -->
	<script src="{{asset('public/design/adminpanel/js/modernizr.min.js')}}" type="text/javascript"></script>
	<script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
	<!--<script src="lib/html5shiv/html5shiv.js"></script>-->
	<!-- Chartinator  -->
	<script src="{{asset('public/design/adminpanel/js/chartinator.js')}}" ></script>
	<script type="text/javascript">
		jQuery(function ($) {

			var chart3 = $('#geoChart').chartinator({
				tableSel: '.geoChart',

				columns: [{role: 'tooltip', type: 'string'}],

				colIndexes: [2],

				rows: [
				['China - 2015'],
				['Colombia - 2015'],
				['France - 2015'],
				['Italy - 2015'],
				['Japan - 2015'],
				['Kazakhstan - 2015'],
				['Mexico - 2015'],
				['Poland - 2015'],
				['Russia - 2015'],
				['Spain - 2015'],
				['Tanzania - 2015'],
				['Turkey - 2015']],

				ignoreCol: [2],

				chartType: 'GeoChart',

				chartAspectRatio: 1.5,

				chartZoom: 1.75,

				chartOffset: [-12,0],

				chartOptions: {

					width: null,

					backgroundColor: '#fff',

					datalessRegionColor: '#F5F5F5',

					region: 'world',

					resolution: 'countries',

					legend: 'none',

					colorAxis: {

						colors: ['#679CCA', '#337AB7']
					},
					tooltip: {

						trigger: 'focus',

						isHtml: true
					}
				}


			});
		});
	</script>
	<!--geo chart-->

	<!--skycons-icons-->
	<script src="{{asset('public/design/adminpanel/js/skycons.js')}}"></script>
	<!--//skycons-icons-->

	<!--custom-js-->
	<script src="{{asset('public/design/adminpanel/js/myFunctions.js')}}"></script>
	<!--//custom-js-->
    <!-- data table-->
    <link type="text/css" href="{{asset('public/design/adminpanel/css/dataTables.bootstrap.min.css')}}">
{{--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
    <script src="{{asset('public/design/adminpanel/js/popper.min.js')}}" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{asset('public/design/adminpanel/js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
</head>
