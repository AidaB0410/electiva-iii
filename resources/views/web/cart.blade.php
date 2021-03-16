@extends('layouts.web')

@section('title', 'Carrito')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url('web/images/bg_2.jpg');">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Inicio</a></span> <span>Carrito</span></p>
				<h1 class="mb-0 bread">Mi Carrito</h1>
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
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Producto</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($products as $product)
							<tr class="text-center cartProduct" code="{{ $product['code'] }}">
								<td class="product-remove"><a code="{{ $product['code'] }}"><span class="ion-ios-close"></span></a></td>
								<td class="image-prod">
									<div class="img" style="background-image:url({{ asset('/admins/img/products/'.$product['product']->image) }});"></div>
								</td>
								<td class="product-name">
									<h3>{{ $product['product']['name']." (".$product['size']['name'].")" }}</h3>
								</td>
								<td class="price">{{ number_format($product['product']['price'], 2, ",", ".") }} Bs</td>
								<td class="quantity">
									<div class="input-group mb-3">
										<input type="text" name="qty" class="quantity qty form-control" value="{{ $product['qty'] }}" min="1" code="{{ $product['code'] }}" slug="{{ $product['product']['slug'] }}" size="{{ $product['size']['slug'] }}" price="{{ $product['product']['price'] }}">
									</div>
								</td>
								<td class="total" code="{{ $product['code'] }}" slug="{{ $product['product']['slug'] }}">{{ number_format($product['product']['price']*$product['qty'], 2, ",", ".") }} Bs</td>
							</tr>
							@empty
							<tr class="text-center">
								<td colspan="6">No hay productos agregados al carrito</td>
							</tr>
							@endforelse
							
							@if(count($products)>0)
							<tr class="text-center">
								<td colspan="4"></td>
								<td>Total:</td>
								<td id="total-cart">{{ number_format($total, 2, ",", ".") }} Bs</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 mt-5 text-right ftco-animate">
				<a href="{{ route('pago.create') }}" class="btn btn-primary py-3 px-4">Siguiente</a>
			</div>
		</div>
	</div>
</section>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
@endsection