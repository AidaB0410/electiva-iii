@extends('layouts.admin')

@section('title', 'Registro de Usuario')
@section('page-title', 'Registro de Usuario')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('usuario.index') }}">Usuarios</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('usuario.store') }}" method="POST" class="form" id="formUser" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Foto (Opcional)</label>
							<input type="file" name="photo" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<div class="row">
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}" id="name">
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="lastname" required placeholder="Introduzca un apellido" value="{{ old('lastname') }}" id="lastname">
								</div>
							</div> 
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Correo Electrónico<b class="text-danger">*</b></label>
							<input class="form-control" type="email" name="email" required placeholder="Introduzca un correo electrónico" value="{{ old('email') }}">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone') }}" id="phone">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">DNI<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="dni" required placeholder="Introduzca su dni" value="{{ old('dni') }}" id="dni">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Tipo<b class="text-danger">*</b></label>
							<select class="form-control" name="type" required id="typeUser">
								<option value="">Seleccione</option>
								<option value="1">Super Administrador</option>
								<option value="2">Cajero</option>
								<option value="3">Repartidor</option>
								<option value="4">Cliente</option>
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12 d-none" id="storeField">
							<label class="col-form-label">Tienda<b class="text-danger">*</b></label>
							<select class="form-control" name="store_id" required>
								<option value="">Seleccione</option>
								@foreach($stores as $store)
								<option value="{{ $store->slug }}">{{ $store->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Contraseña<b class="text-danger">*</b></label>
							<input class="form-control" type="password" name="password" required placeholder="********" id="password">
						</div>
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Confirmar Contraseña<b class="text-danger">*</b></label>
							<input class="form-control" type="password" name="password_confirmation" required placeholder="********">
						</div>
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="user">Guardar</button>
								<a href="{{ route('usuario.index') }}" class="btn btn-secondary">Volver</a>
							</div>
						</div> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection