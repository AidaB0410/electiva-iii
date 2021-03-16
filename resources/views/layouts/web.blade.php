<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	<link rel="icon" href="{{ asset('/auth/images/icons/favicon.ico') }}" type="image/x-icon" />

	<meta name="description" content="La pizzería restaurante Maesma es el lugar ideal para disfrutar de una buena pizza estilo americano, la frescura de los productos y po la cortesía de un ambiente agradable y de un personal calificado.">
	<meta property="og:title" content="Maesma Pizzería" />
	<meta property="og:description" content="La pizzería restaurante Maesma es el lugar ideal para disfrutar de una buena pizza estilo americano, la frescura de los productos y po la cortesía de un ambiente agradable y de un personal calificado." />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="https://www.maesma.com" />
	<meta property="og:image" content="https://www.maesma.com/admins/img/logo.png" />

	<link href="{{ asset('/web/fonts/poppins/poppins.css') }}" rel="stylesheet">
	<link href="{{ asset('/web/fonts/lora/lora.css') }}" rel="stylesheet">
	<link href="{{ asset('/web/fonts/amatic-sc/amatic-sc.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('/web/css/open-iconic-bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/web/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">

	<link rel="stylesheet" href="{{ asset('/web/css/ionicons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/web/css/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('/web/css/icomoon.css') }}">
	<link rel="stylesheet" href="{{ asset('/web/css/style.css') }}">

	@yield('links')
</head>
<body class="goto-here">	

	@include('web.partials.navbar')

	@yield('content')

	
	@include('web.partials.loader')

	<script src="{{ asset('/web/js/jquery.min.js') }}"></script>
	<script src="{{ asset('/web/js/jquery-migrate-3.0.1.min.js') }}"></script>
	<script src="{{ asset('/web/js/popper.min.js') }}"></script>
	<script src="{{ asset('/web/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/web/vendors/lobibox/Lobibox.js') }}"></script>
	<script src="{{ asset('/web/vendors/jquery-load-scroll/jQuery.loadScroll.js') }}"></script>

	<script src="{{ asset('/web/js/jquery.easing.1.3.js') }}"></script>
	<script src="{{ asset('/web/js/jquery.waypoints.min.js') }}"></script>
	@yield('script')
	<script src="{{ asset('/web/js/main.js') }}"></script>
	@include('web.partials.notifications')
</body>
</html>