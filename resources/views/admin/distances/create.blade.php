@extends('layouts.admin')

@section('title', 'Registro de Distancia')
@section('page-title', 'Registro de Distancia')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('distancias.index') }}">Distancias</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('distancias.store') }}" method="POST" class="form" id="formDistance">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Kilometros<b class="text-danger">*</b></label>
							<input class="form-control km" type="text" name="km" required placeholder="Introduzca la cantidad en km" value="0.0">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Precio<b class="text-danger">*</b></label>
							<input class="form-control price" type="text" name="price" required placeholder="Introduzca un precio" value="0.00">
						</div>

						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="distance">Guardar</button>
								<a href="{{ route('distancias.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection