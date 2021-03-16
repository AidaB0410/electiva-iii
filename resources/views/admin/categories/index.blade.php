@extends('layouts.admin')

@section('title', 'Lista de Categorías')
@section('page-title', 'Lista de Categorías')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Categorías</li>
<li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tablaExport" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $category->name }}</td>
								<td class="d-flex">
									<a class="btn btn-info btn-circle btn-sm" href="{{ route('categorias.edit', ['slug' => $category->slug]) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
									@if(count($category->products)==0)
									<button class="btn btn-danger btn-circle btn-sm" onclick="deleteCategory('{{ $category->slug }}')"><i class="fa fa-trash"></i></button>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar esta categoría?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formDeleteCategory">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/dataTables.flash.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/jszip.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/pdfmake.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/buttons/buttons.print.min.js') }}"></script>
@endsection