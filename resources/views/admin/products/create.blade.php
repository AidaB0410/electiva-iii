@extends('layouts.admin')

@section('title', 'Registro de Producto')
@section('page-title', 'Registro de Producto')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('productos.store') }}" method="POST" class="form" id="formProduct" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Tiendas<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="store_id[]" multiple required>
								@if(!is_array(old('store_id')) || empty(old('store_id')))
								@foreach($stores as $store)
								<option value="{{ $store->slug }}">{{ $store->name }}</option>
								@endforeach
								@else
								{!! selectArray($stores, old('store_id')) !!}
								@endif
							</select>
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Categoria<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="category_id" required>
								<option value="">Seleccione</option>
								@foreach($categories as $category)
								<option value="{{ $category->slug }}">{{ $category->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-lg-3 col-md-3 col-12">
							<label class="col-form-label">¿Tendrá varios tamaños?<b class="text-danger">*</b></label>
							<select class="form-control" name="size-question" required>
								<option value="0">No</option>
								<option value="1">Si</option>
							</select>
						</div>

						<div class="form-group col-lg-3 col-md-3 col-12" id="price-unique">
							<label class="col-form-label">Precio<b class="text-danger">*</b></label>
							<input class="form-control price" type="text" name="price-unique" required placeholder="Introduzca el precio" value="0.00">
						</div>

						<div class="form-group col-lg-3 col-md-3 col-12 d-none" id="div-select-size">
							<label class="col-form-label">Tamaño<b class="text-danger">*</b></label>
							<div class="input-group">
								<select class="form-control" id="select-size">
									<option value="">Seleccione</option>
									@foreach($sizes as $size)
									@if($size->slug!="unico")
									<option value="{{ $size->slug }}">{{ $size->name }}</option>
									@endif
									@endforeach
								</select>
								<button type="type" class="btn btn-primary text-white input-group-addon" id="btn-select-size" disabled>Agregar</button>
							</div>
						</div>

						<div class="col-12">
							<div class="row" id="newSizes"></div>
						</div>

						<div class="form-group col-lg-12 col-md-12 col-12">
							<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
							<textarea class="form-control" rows="4" name="description" required placeholder="Introduzca una descripción">{{ old('description') }}</textarea>
						</div>

						<div class="form-group col-12">
							<label class="col-form-label">Imagen (Opcional)</label>
							<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
						</div>

						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="product">Guardar</button>
								<a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection