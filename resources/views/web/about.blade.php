@extends('layouts.web')

@section('title', 'Nosotros')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('web/images/bg_2.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Inicio</a></span> <span>Nosotros</span></p>
				<h1 class="mb-0 bread">Nosotros</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			@forelse($pages as $page)
			<div class="col-lg-4 col-md-6 col-12 ftco-animate mb-4">
				<div class="card">
					<img src="{{ asset('/admins/img/pages/'.$page->image) }}" class="card-img-top" alt="{{ $page->title }}">
					<div class="card-body text-center">
						<h5>{{ $page->title }}</h5>
						<p class="card-text">{{ $page->description }}</p>
					</div>
				</div>
			</div>
			@empty
			<div class="col-12">
				<h3 class="text-center text-primary">La página se encuentra vacía.</h3>
			</div>
			@endforelse
		</div>
	</div>
</section>

@endsection