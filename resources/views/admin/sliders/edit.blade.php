@extends('layouts.admin')

@section('title', 'Editar Slider')
@section('page-title', 'Editar Slider')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">Sliders</a></li>
<li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('sliders.update', ['slug' => $slider->slug]) }}" method="POST" class="form" id="formSliderEdit" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="form-group col-12">
							<label class="col-form-label">Título<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="title" required placeholder="Introduzca un título" value="{{ $slider->title }}">
						</div>

						<div class="form-group col-12">
							<label class="col-form-label">Descripción<b class="text-danger">*</b></label>
							<textarea class="form-control" rows="5" name="description" required placeholder="Introduzca una descripción">{{ $slider->description }}</textarea>
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Link<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="link" required placeholder="Introduzca un link" value="{{ $slider->link }}">
						</div>

						<div class="form-group col-lg-6 col-md-6 col-12">
							<label class="col-form-label">Estado<b class="text-danger">*</b></label>
							<select class="form-control" name="state" required>
								<option value="1" @if($slider->state==1) selected @endif>Activo</option>
								<option value="2" @if($slider->state==2) selected @endif>Inactivo</option>
							</select>
						</div>

						<div class="form-group col-12">
							<label class="col-form-label">Imagen<b class="text-danger">*</b></label>
							<input type="file" name="image" accept="image/*" id="input-file-now" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ '/admins/img/sliders/'.$slider->image }}" />
						</div>

						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="sliderEdit">Actualizar</button>
								<a href="{{ route('sliders.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection