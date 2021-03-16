@extends('layouts.web')

@section('title', 'Detalle de Compra')

@section('content')
<section class="ftco-section bg-light ftco-no-pt">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-7 col-12 mt-4 ftco-animate">
				<div class="cart-detail p-3 p-md-4 bg-white">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-12">
							<p><strong>Estado:</strong> {!! saleState($sale->state) !!}</p>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<p><strong>Fecha del Pago:</strong> {{ date('d-m-Y H:i a', strtotime($sale->created_at)) }}</p>
						</div>
						<div class="col-12 ftco-animate">
							<a href="{{ route('pago.index') }}" class="btn btn-secondary">Volver</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-5 col-12 mt-4 ftco-animate">
				<div class="cart-detail cart-total p-3 p-md-4 bg-white">
					<h3 class="billing-heading mb-2">Total del Pago</h3>
					<p class="d-flex">
						<span>Subtotal</span>
						<span>{{ number_format($sale->subtotal, 2, ',', '.')." Bs" }}</span>
					</p>
					<hr>
					<p class="d-flex total-price">
						<span>Total</span>
						<span>{{ number_format($sale->total, 2, ",", ".")." Bs" }}</span>
					</p>
				</div>
			</div>

			<div class="col-md-12 ftco-animate mt-4">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>#</th>
								<th>Imagen</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							@foreach($sale->orders as $order)
							<tr>
								<td>{{ $num++ }}</td>
								<td class="image-prod">
									<div class="img" title="{{ $order->product->name }}" style="background-image:url({{ asset('/admins/img/products/'.$order->product->image) }});"></div>
								</td>
								<td class="product-name">
									<h3>{{ $order->product->name." (".$order->size->name.")" }}</h3>
								</td>
								<td>{{ $order->qty }}</td>
								<td class="price">{{ number_format($order->price, 2, ",", ".") }} Bs</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/datatables/jquery.dataTables.min.js') }}"></script>
@endsection