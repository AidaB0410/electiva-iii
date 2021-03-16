@extends('layouts.admin')

@section('title', 'Lista de Ventas')
@section('page-title', 'Lista de Ventas')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/lobibox/Lobibox.min.css') }}">
@endsection

@section('breadcrumb')
<li class="breadcrumb-item">Ventas</li>
<li class="breadcrumb-item active">Lista</li>
@endsection

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tabla" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>#</th>
								<th>Cliente</th>
								<th>Tipo de Pago</th>
								<th>Referencia</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sale as $s)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $s->user->name." ".$s->user->lastname }}</td>
								<td>{!! pay($s->type_pay) !!}</td>
								<td>{{ $s->reference }}</td>
								<td>{!! saleState($s->state) !!}</td>
								<td class="d-flex">
									<a class="btn btn-primary btn-circle btn-sm" href="{{ route('venta.show', ['slug' => $s->slug]) }}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
									<a class="btn btn-success btn-circle btn-sm text-white" onclick="confirmState('{{ $s->slug }}')"><i class="fa fa-check"></i></a>&nbsp;&nbsp;
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

<div class="modal fade" id="confirmUsers" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Introduzca el cajero y repartidor correspondiente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<form action="#" method="POST" id="formConfirmUsers">
					@csrf
					<div class="row">
						<div class="form-group col-6">
							<label class="col-form-label">Cajero<b class="text-danger">*</b></label>
							<select class="form-control" name="casher_id" required>
								<option>Seleccione</option>
								@foreach($casher as $c)
								<option value="{{ $c->slug }}">{{ $c->name." ".$c->lastname }} -> {{ $c->store->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-6">
							<label class="col-form-label">Repartidor<b class="text-danger">*</b></label>
							<select class="form-control" name="delivery_man_id" required>
								<option>Seleccione</option>
								@foreach($deliveryMan as $d)
								<option value="{{ $d->slug }}">{{ $d->name." ".$d->lastname }} -> {{ $d->store->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-12 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary mr-2">Asignar</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmTime" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Desea inicializar el tiempo de entrega?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="POST" id="formConfirmTime" class="modal-footer">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12 d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Si</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmState" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Seleccione el estado actual del pedido</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="POST" id="formConfirmState" class="modal-footer">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12">
						<label class="col-form-label">Estado<b class="text-danger">*</b></label>
						<select class="form-control" name="state" required>
							<option>Seleccione</option>
							<option value="1">Preparación En Proceso</option>
							<option value="3">Entregado</option>
							<option value="4">Reembolso</option>
							<option value="6">Error en el pago</option>
							<option value="7">Pago mediante cheque pendiente</option>
							<option value="8">Pago por transferencia bancaria pendiente</option>
							<option value="10">Pago Aceptado</option>
							<option value="11">Cancelado</option>
						</select>
					</div>
					<div class="form-group col-12 d-flex justify-content-end">
						<button type="submit" class="btn btn-primary mr-2">Cambiar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{ asset('/admins/vendors/lobibox/Lobibox.js') }}"></script>
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admins/js/timer.jquery.js') }}"></script>
@endsection