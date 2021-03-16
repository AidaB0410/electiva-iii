@extends('layouts.admin')

@section('title', 'Lista de Servicios')
@section('page-title', 'Lista de Servicios')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Servicios</li>
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
								<th>Título</th>
								<th>Descripción</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($services as $service)
							<tr>
								<td>{{ $num++ }}</td>
								<td>
									<span class="image-list">
										<a data-toggle="tooltip" data-placement="bottom" data-html="true" title="<img src='{{ asset('/admins/img/services/'.$service->image) }}' style='width: 150px; height: 150px;' >"><img src="{{ asset('/admins/img/services/'.$service->image) }}" class="img-circle" alt="Foto del slider" width="40" height="40" /> {{ $service->title }}</a>
									</span>
								</td>
								<td>{{ $service->description }}</td>
								<td>{!! state($service->state) !!}</td>
								<td class="d-flex">
									<a class="btn btn-info btn-circle btn-sm" href="{{ route('servicios.edit', ['slug' => $service->slug]) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
									<button class="btn btn-danger btn-circle btn-sm" onclick="deleteService('{{ $service->slug }}')"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="deleteService" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar este servicio?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formDeleteService">
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