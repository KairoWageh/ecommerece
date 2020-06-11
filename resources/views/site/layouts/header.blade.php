<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            @if(session('lang') == 'ar')
                {{ setting()->sitename_ar }}
            @else
                {{ setting()->sitename_en }}
            @endif
        </title>
    
        <!-- Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset('design/site/css/bootstrap.min.css') }}"> 
        <!-- only in arabic -->
        @if(session('lang') == 'ar')
            <link rel="stylesheet" href="{{ asset('design/site/css/bootstrap-rtl.css') }}">
        @endif
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('design/site/css/font-awesome.min.css') }}">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('design/site/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('design/site/style.css') }}">
        <link rel="stylesheet" href="{{ asset('design/site/css/responsive.css') }}">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="icon" href="{{ Storage::url(setting()->icon) }}">
    </head>
    <body>