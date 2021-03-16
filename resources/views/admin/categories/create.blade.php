@extends('layouts.admin')

@section('title', 'Registro de Categoria')
@section('page-title', 'Registro de Categoria')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/dropify/css/dropify.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorias</a></li>
<li class="breadcrumb-item active">Registro</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">

				@include('admin.partials.errors')

				<h6 class="card-subtitle">Campos obligatorios (<b class="text-danger">*</b>)</h6>
				<form action="{{ route('categorias.store') }}" method="POST" class="form" id="formCategory" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-lg-12 col-md-12 col-12">
							<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
							<input class="form-control" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
						</div>
						<div class="form-group col-12">
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary" action="category">Guardar</button>
								<a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
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