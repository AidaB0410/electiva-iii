@extends('layouts.admin')

@section('title', 'Detalles de la Venta')
@section('page-title', 'Detalles de la Venta')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('venta.index') }}">Ventas</a></li>
<li class="breadcrumb-item active">Detalles</li>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12 col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="d-flex">
					<div class="mb-4">
						<h4 class="card-title"><span class="lstick"></span>Estado: {!! saleState($sale->state) !!}</h4>
					</div>
					<div class="ml-auto">
						<h5 class="card-title"><span class="lstick"></span>Fecha: {{ date('d-m-Y H:i a', strtotime($sale->created_at)) }}</h5>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7 col-md-7 col-12 ftco-animate">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Pedido:</strong> N° {{ $sale->id }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Cliente:</strong> {{ $sale->user->name." ".$sale->user->lastname }} </p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Teléfono:</strong> {{ $sale->phone }}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Tipo de pago:</strong> {!! pay($sale->type_pay) !!}</p>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<p><strong>Referencia:</strong> {{ $sale->reference }}</p>
							</div>
							
							
							
							
							<div class="col-12">
								<strong>Dirección</strong> {{ $sale->address }}
							</div>
						</div>
					</div>

					<div class="col-lg-5 col-md-5 col-12 ftco-animate">
						<div class="cart-detail cart-total p-3 p-md-4 bg-light">
							<h3 class="billing-heading mb-2">Total del Pago</h3>
							<p class="d-flex justify-content-between">
								<span>Subtotal</span>
								<span>{{ number_format($sale->subtotal, 2, ",", ".")." Bs" }}</span>
							</p>
							<hr>
							<p class="d-flex justify-content-between">
								<span>Total</span>
								<span>{{ number_format($sale->total, 2, ",", ".")." Bs" }}</span>
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="tabla" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr class="text-center">
								<th>#</th>
								<th>Producto</th>
								<th>Tamaño</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order as $o)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $o->product->name }}
								</td>
								<td>{{ $o->size->name }}</td>
								<td>{{ $o->qty }}</td>
								<td>{{ number_format($o->price, 2, ",", ".")." Bs" }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admins/js/timer.jquery.js') }}"></script>
@endsection