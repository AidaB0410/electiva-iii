@extends('layouts.admin')

@section('title', 'Editar Tienda')
@section('page-title', 'Editar Tienda')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('tienda.index') }}">Tiendas</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('tienda.update', ['slug' => $store->slug]) }}" method="POST" class="form" id="formStore" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ $store->name }}">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Primer Teléfono<b class="text-danger">*</b></label>
							<input class="form-control number" type="text" name="phone_one" required placeholder="Introduzca un teléfono" value="{{ $store->phone_one }}">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Segundo Teléfono (Opcional)</label>
							<input class="form-control number" type="text" name="phone_two" placeholder="Introduzca un teléfono" value="{{ $store->phone_two }}">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="address" required placeholder="Seleccione una dirección" value="{{ $store->address }}">
						</div>

						<div class="form-group col-12">
							<label class="col-form-label">Imagen (Opcional)</label>
							<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ '/admins/img/stores/'.$store->image }}" />
						</div>

						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="store">Actualizar</button>
								<a href="{{ route('tienda.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection