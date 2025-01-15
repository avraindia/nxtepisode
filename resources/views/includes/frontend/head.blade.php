<meta charset="utf-8">
<meta http-equiv="content-language" content="en-us">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Pragma" content="no-cache">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
@php
    $route_name = request()-> route()-> getname();
@endphp

<title>Next Episode</title>
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/font-awesome-6/css/all.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
<!-- <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css?v=1.0.2') }}"> -->
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/menu.css?v=1.0.4') }}">
@if ($route_name == "home")
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/home-style.css?v=1.0.4') }}">
@else
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css?v=1.0.4') }}">
@endif

<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/fixing.css?v=1.0.4') }}">
<link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/responsive.css?v=1.0.4') }}">
<link type="image/ico" rel="icon" href="{{ asset('frontend/images/favicon.png') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>