@extends('layouts.web')

@section('title', 'Ubicación')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('web/images/bg_2.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Inicio</a></span> <span>Ubicación</span></p>
				<h1 class="mb-0 bread">Ubicación</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			@foreach($stores as $store)
			<div class="col-lg-4 col-md-6 col-12 ftco-animate">
				<h5>{{ $store->name }}</h5>
				<p><strong>Dirección:</strong> {{ $store->address }}<br><strong>Teléfono:</strong> {{ $store->phone_one }} @if($store->phone_two!=NULL) {{ $store->phone_two }} @endif</p>
			</div>
			@endforeach
		</div>
	</div>

	<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d21539.919951533986!2d-66.15001568713983!3d-17.375476670536546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1smaesma!5e0!3m2!1ses!2sbo!4v1543502164856" width="100%" height="500" frameborder="0" allowfullscreen></iframe>
</section>

@endsection