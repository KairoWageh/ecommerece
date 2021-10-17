<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{!empty($title)?$title:__('adminpanel')}}</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('public/design/admin/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('public/design/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/design/admin/dist/css/adminlte.min.css') }}">
        <link href="{{asset('public/design/admin/css/style.css')}}" rel="stylesheet" type="text/css" media="all">
        @if(app()->getLocale() == 'ar')
            <link href="{{asset('public/design/admin/css/bootstrap-rtl.css')}}" rel="stylesheet" type="text/css" media="all">
            <link href="{{asset('public/design/admin/css/style-ar.css')}}" rel="stylesheet" type="text/css" media="all">
        @endif
    <!-- jQuery -->
{{--        <script src="{{ asset('public/design/admin/plugins/jquery/jquery.min.js') }}"></script>--}}
        <link type="text/css" href="{{asset('public/design/admin/css/dataTables.bootstrap.min.css')}}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('public/design/admin/css/toastr.min.css') }}">
        <!-- Jstree -->
        <link rel="stylesheet" href="{{ asset('public/design/admin/jstree/themes/default/style.css') }}" />
{{--        <link href="{{asset('public/design/admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">--}}
        <link type="text/css" href="{{asset('public/design/admin/css/bootstrap-datepicker.min.css')}}">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

{{--            <!-- Preloader -->--}}
{{--            <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--                <img class="animation__wobble" src="{{ asset('public/design/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">--}}
{{--            </div>--}}
