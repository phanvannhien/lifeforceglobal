<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('assets/ico/apple-touch-icon-144-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('assets/ico/apple-touch-icon-114-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('assets/ico/apple-touch-icon-72-precomposed.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ url('ico/apple-touch-icon-57-precomposed.png') }}">
<link rel="shortcut icon" href="{{ url('assets/ico/favicon.png') }}">
<title>Lifeforce Global</title>
 
<link href="{{ url('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
 
<link id="pagestyle" rel="stylesheet" type="text/css" href="{{ url('assets/css/skin-1.css') }}">
 
<link href="{{ url('assets/css/style.css') }}" rel="stylesheet">

 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
 
@if (Request::is('user/order-history'))
<link href="{{ url('assets/css/footable-0.1.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ url('assets/css/footable.sortable-0.1.css') }}" rel="stylesheet" type="text/css"/>

@endif
</head>

<body>

@include('front.partials.login')
@include('front.partials.register')