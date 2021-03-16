@extends('layouts.web')

@section('title', 'Comprar')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/leaflet/leaflet.css') }}">
@endsection

@section('content')

<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-4 col-lg-4 order-lg-1 order-xl-1">
				<div class="row">
					<div class="col-md-12 d-flex mb-5">
						<div class="cart-detail cart-total p-3 p-md-4">
							<h3 class="billing-heading mb-4">Total de La Compra</h3>
							<p class="d-flex">
								<span>N° de Cuenta Venezuela</span>
								<span >010200000000000000</span>
							</p>
							<hr>
							<p class="d-flex">
								<span>Pago Movil</span>
								<span >0102 - 0000000 - (0000) 0000000</span>
							</p>
							<hr>
							<p class="d-flex">
								<span>Subtotal</span>
								<span id="subtotal">{{ number_format($total, 2, ",", ".") }} Bs</span>
							</p>
							<hr>
							<p class="d-flex total-price">
								<span>Total</span>
								<span id="total" total="{{ $total }}">{{ number_format($total, 2, ",", ".") }} Bs</span>
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				@include('admin.partials.errors')
			</div>

			@guest
			<div class="col-xl-4 col-lg-4 order-lg-0 order-xl-0 ftco-animate">
				<form action="{{ route('login') }}" method="POST" id="formLogin">
					@csrf
					<div class="row align-items-end">
						<div class="col-12">
							<div class="cart-detail cart-total p-3 p-md-4 bg-white">
								<p class="h4 text-center mt-2">Iniciar Sesión</p>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Correo Electrónico</label>
											<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="{{ 'ejemplo@gmail.com' }}" value="{{ old('email') }}">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Contraseña</label>
											<input class="form-control @error('password') is-invalid @enderror" type="password" required name="password" placeholder="********">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group text-center">
											<button class="btn btn-primary" type="submit" action="login">Ingresar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>

			<div class="col-xl-4 col-lg-4 order-lg-0 order-xl-0 ftco-animate">
				<form action="{{ route('register') }}" method="POST" id="formRegister">
					@csrf
					<div class="row align-items-end">
						<div class="col-12">
							<div class="cart-detail cart-total p-3 p-md-4 bg-white">
								<p class="h4 text-center mt-2">Registrarse</p>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Nombre</label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Ejm: Juan" value="{{ old('name') }}" autocomplete="name" autofocus>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<div class="form-group">
											<label>Apellido</label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Ejm: Lopez" value="{{ old('lastname') }}" autocomplete="lastname">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Correo Electrónico</label>
											<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="{{ 'ejemplo@gmail.com' }}" value="{{ old('email') }}">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Contraseña</label>
											<input class="form-control @error('password') is-invalid @enderror" type="password" required name="password" placeholder="********" id="password">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Confirmar Contraseña</label>
											<input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="********">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group text-center">
											<button class="btn btn-primary" type="submit" action="register">Registrarse</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			@else
			<div class="col-xl-8 col-lg-8 order-lg-0 order-xl-0 ftco-animate">
				<form action="{{ route('pago.store') }}" method="POST" id="formSale" class="billing-form">
					@csrf
					<h3 class="mb-4 billing-heading">Detalles de La Compra</h3>
					<div class="row align-items-end">
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="firstname">Nombre y Apellido</label>
								<input type="text" class="form-control" disabled value="{{ Auth::user()->name.' '.Auth::user()->lastname }}">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="emailaddress">Correo Electrónico</label>
								<input type="text" class="form-control" disabled value="{{ Auth::user()->email }}">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">Teléfono</label>
								<input type="text" class="form-control" required name="phone" placeholder="Introduzca su número telefónico" @if(Auth::user()->phone!=NULL) value="{{ Auth::user()->phone }}" @endif>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">DNI</label>
								<input type="text" class="form-control" required name="dni" placeholder="Introduzca su dni"  @if(Auth::user()->dni!=NULL) value="{{ Auth::user()->dni }}" readonly @endif>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="pay">Tipo de Pago</label>
								<select name="type_pay" class="form-control" required="">
									<option value="1">Transferencia</option>
									<option value="2">Pago Móvil</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<div class="form-group">
								<label for="phone">Referencia</label>
								<input type="text" class="form-control" required name="reference" placeholder="Introduzca su referencia">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="streetaddress">Dirección</label>
								<input type="text" name="address" class="form-control" required placeholder="Introduzca su dirección (calle, número de casa, avenida, etc)">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<p>
									<button type="submit" action="sale" class="btn btn-primary py-3 px-4">Finalizar Compra</button>
									<a href="{{ route('menu') }}" class="btn btn-primary py-3 px-4">Seguir Comprando</a>
								</p>
							</div>
						</div> 
					</div>
				</form>
			</div>
			@endguest
		</div>
	</div>
</section>



@endsection

@section('script')
<script src="{{ asset('/admins/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('/admins/vendors/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendors/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
@endsection