@extends('layouts.admin')

@section('title', 'Inicio')
@section('page-title', 'Panel de Inicio')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body little-profile text-center">
				<h3 class="m-b-3">Bienvenid@ {{ Auth::user()->name." ".Auth::user()->lastname }}</h3>
			</div>
			<div class="text-center bg-light">
				<div class="row">
					<div class="col-6  p-20 b-r">
						<h4 class="m-b-0 font-medium">{{ $actives }}</h4>
						<small>Usuarios Activos</small>
					</div>
					<div class="col-6  p-20">
						<h4 class="m-b-0 font-medium">{{ $inactives }}</h4>
						<small>Usuarios Inactivos</small>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="d-flex no-block">
					<div class="m-r-20 align-self-center">
						<span class="lstick m-r-20"></span>
						<img src="{{ '/admins/img/icon/assets.png'}}" alt="Productos" />
					</div>
					<div class="align-self-center">
						<h6 class="text-muted m-t-10 m-b-0">Productos</h6>
						<h2 class="m-t-0">{{ $products }}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="d-flex no-block">
					<div class="m-r-20 align-self-center">
						<span class="lstick m-r-20"></span>
						<img src="{{ '/admins/img/icon/income.png'}}" alt="Categorías" />
					</div>
					<div class="align-self-center">
						<h6 class="text-muted m-t-10 m-b-0">Categorías</h6>
						<h2 class="m-t-0">{{ $categories }}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="card">
			<div class="card-body">
				<div class="d-flex no-block">
					<div class="m-r-20 align-self-center">
						<span class="lstick m-r-20"></span>
						<img src="{{ '/admins/img/icon/assets.png'}}" alt="Ventas" />
					</div>
					<div class="align-self-center">
						<h6 class="text-muted m-t-10 m-b-0">Ventas</h6>
						<h2 class="m-t-0">{{ $sales }}</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><span class="lstick"></span>Módulos del Sistema</h4>
				<ul class="feeds">
					<li>
						<div class="bg-light-info"><i class="fa fa-bell-o"></i></div> 
						Control de Almacenamiento de Categorías (Productos)
					</li>
					<li>
						<div class="bg-light-success"><i class="ti-user"></i></div>Registro y Control de Usuarios
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection