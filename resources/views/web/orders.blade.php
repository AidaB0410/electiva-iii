@extends('layouts.web')

@section('title', 'Compras')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('web/images/bg_2.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Inicio</a></span> <span>Compras</span></p>
				<h1 class="mb-0 bread">Compras Realizadas</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section ftco-cart">
	<div class="container">
		<div class="row">
			<div class="col-md-12 ftco-animate">
				<div class="cart-list">
					<table class="table">
						<thead class="thead-primary">
							<tr class="text-center">
								<th>#</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Fecha</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse($sales as $s)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ number_format($s->total, 2, ",", ".")." Bs" }}</td>
								<td>{!! saleState($s->state) !!}</td>
								<td>{{ $s->created_at->format('d-m-Y H:i a') }}</td>
								<td class="d-flex justify-content-center">
									<a href="{{ route('pago.order', ['slug' => $s->slug]) }}" class="btn btn-primary"><i class="icon-eye"></i></a>
								</td>
							</tr>
							@empty
							<tr class="text-center">
								<td colspan="6">No se ha realizado ninguna compra.</td>
							</tr>
							@endforelse
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