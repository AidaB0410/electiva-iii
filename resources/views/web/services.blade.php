@extends('layouts.web')

@section('title', 'Servicios')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('web/images/bg_2.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Inicio</a></span> <span>Servicios</span></p>
				<h1 class="mb-0 bread">Servicios</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			@forelse($services as $service)
			<div class="col-lg-4 col-md-4 col-12 px-4 py-4 ftco-animate @if($loop->iteration%3!=0) border-xl-right border-lg-right @endif @if($loop->iteration<$loop->count-2) border-bottom @endif @if($loop->iteration==$loop->count-2 || $loop->iteration==$loop->count-1) border-md-bottom border-sm-bottom @endif">
				<h4 class="text-primary">@if($num<10) {{ "0".$num++ }} @else {{ $num++ }} @endif</h4>
				<h4>{{ $service->title }}</h4>
				<p>{{ $service->description }}</p>
			</div>
			@empty
			<div class="col-12">
				<h3 class="text-center text-primary">No hay ningún servicio.</h3>
			</div>
			@endforelse
		</div>
	</div>
</section>

@endsection