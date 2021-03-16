@extends('layouts.admin')

@section('title', 'Editar Producto')
@section('page-title', 'Editar Producto')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/multiselect/bootstrap.multiselect.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('productos.update', ['slug' => $product->slug]) }}" method="POST" class="form" id="formProduct" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ $product->name }}">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Tiendas<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="store_id[]" multiple required>
								{!! selectArray($stores, $product->stores) !!}
							</select>
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Categoría<b class="text-danger">*</b></label>
							<select class="form-control multiselect" name="category_id" required>
								<option value="">Seleccione</option>
								@foreach($categories as $category)
								<option value="{{ $category->slug }}" @if($product->category->slug==$category->slug) selected @endif>{{ $category->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-lg-3 col-md-3 col-12">
							<label class="col-form-label">¿Tendrá varios tamaños?<b class="text-danger">*</b></label>
							<select class="form-control" name="size-question" required>
								<option value="0" @if(count($product->sizes)<2 && $product->sizes[0]->slug=="normal") selected @endif>No</option>
								<option value="1" @if(count($product->sizes)>1 || $product->sizes[0]->slug!="normal") selected @endif>Si</option>
							</select>
						</div>

						<div class="form-group col-lg-3 col-md-3 col-12 @if(count($product->sizes)>1 || $product->sizes[0]->slug!="normal") d-none @endif" id="price-unique">
							<label class="col-form-label">Precio<b class="text-danger">*</b></label>
							<input class="form-control price" type="text" name="price-unique" required placeholder="Introduzca el precio" value="@if(count($product->sizes)<2 && $product->sizes[0]->slug=="normal"){{ $product->sizes[0]->pivot->price }}@else{{ '0.00' }}@endif">
						</div>

						<div class="form-group col-lg-3 col-md-3 col-12 @if(count($product->sizes)<2 && $product->sizes[0]->slug=="normal") d-none @endif" id="div-select-size">
							<label class="col-form-label">Tamaño<b class="text-danger">*</b></label>
							<div class="input-group">
								<select class="form-control" id="select-size">
									<option value="">Seleccione</option>
									@if(count($product->sizes)<2 && $product->sizes[0]->slug=="normal")
									@foreach($sizes as $size)
									@if($size->slug!="normal")
									<option value="{{ $size->slug }}">{{ $size->name }}</option>
									@endif
									@endforeach
									@else
									{!! selectSizesProduct($sizes, $product->sizes) !!}
									@endif
								</select>
								<button type="type" class="btn btn-primary text-white input-group-addon" id="btn-select-size" disabled>Agregar</button>
							</div>
						</div>

						<div class="col-12">
							<div class="row" id="newSizes">
								@if(count($product->sizes)>1 || $product->sizes[0]->slug!="normal")
								@foreach($product->sizes as $size)
								<div class="form-group col-lg-2 col-md-2 col-12 size" size="{{ $size->slug }}">
									<label class="col-form-label">Tamaño</label>
									<input type="text" class="form-control" disabled="disabled" value="{{ $size->name }}">
									<input type="hidden" class="form-control" name="size[]" value="{{ $size->slug }}">
								</div>

								<div class="form-group col-lg-3 col-md-3 col-9 size" size="{{ $size->slug }}">
									<label class="col-form-label">Precio<b class="text-danger">*</b></label>
									<input type="text" class="form-control price" name="price[]" required value="{{ $size->pivot->price }}">
								</div>

								<div class="form-group col-lg-1 col-md-1 col-3 size" size="{{ $size->slug }}">
									<button type="button" class="btn btn-danger mt-4 deleteSize" size="{{ $size->slug }}"><i class="fa fa-close"></i></button>
								</div>
								@endforeach
								@endif
							</div>
						</div>

						<div class="form-group col-lg-12 col-md-12 col-12">
							<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
							<textarea class="form-control" rows="4" name="description" required placeholder="Introduzca una descripción">{{ $product->description }}</textarea>
						</div>

						<div class="form-group col-12">
							<label class="col-form-label">Imagen (Opcional)</label>
							<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ '/admins/img/products/'.$product->image }}" />
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Estado<b class="text-danger">*</b></label>
							<select class="form-control" name="state" required>
								<option value="1" @if($product->state==1) selected @endif>Activo</option>
								<option value="2" @if($product->state==2) selected @endif>Inactivo</option>
							</select>
						</div>

						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="product">Actualizar</button>
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
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection