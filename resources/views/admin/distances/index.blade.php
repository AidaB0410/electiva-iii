@extends('layouts.admin')

@section('title', 'Lista de Distancias')
@section('page-title', 'Lista de Distancias')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Distancias</li>
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
								<th>Kilometros</th>
								<th>Precio</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($distances as $distance)
							<tr>
								<td>{{ $num++ }}</td>
								<td>
									@if($distance->km>0)
									{{ number_format($distance->km, 1, ",", ".")." kilometros" }}
									@else
									Local
									@endif
								</td>
								<td>
									@if($distance->price>0)
									{{ number_format($distance->price, 2, ",", ".")." Bs" }}
									@else
									Gratis
									@endif
								</td>
								<td class="d-flex">
									<a class="btn btn-info btn-circle btn-sm" href="{{ route('distancias.edit', ['slug' => $distance->slug]) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
									{{-- @if(count($distance->products)==0) --}}
									<button class="btn btn-danger btn-circle btn-sm" onclick="deleteDistance('{{ $distance->slug }}')"><i class="fa fa-trash"></i></button>
									{{-- @endif --}}
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

<div class="modal fade" id="deleteDistance" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar esta distancia?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formDeleteDistance">
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