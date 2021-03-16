<footer class="ftco-footer ftco-section">
	<div class="container">
		<div class="row">
			<div class="mouse">
				<a href="#" class="mouse-icon">
					<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
				</a>
			</div>
		</div>
		<div class="row mb-5">
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<img src="{{ asset('/admins/img/logo.png') }}" width="160">
					<p>La pizzería restaurante "Maesma" es el lugar ideal para disfrutar de una buena pizza estilo americano, la frescura de los productos y po la cortesía de un ambiente agradable y de un personal calificado.</p>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4 ml-md-5">
					<h2 class="ftco-heading-2">Menú</h2>
					<ul class="list-unstyled">
						<li><a href="{{ route('home') }}" class="py-2 d-block">Inicio</a></li>
						<li><a href="{{ route('about') }}" class="py-2 d-block">Nosotros</a></li>
						<li><a href="{{ route('services') }}" class="py-2 d-block">Servicios</a></li>
						<li><a href="{{ route('menu') }}" class="py-2 d-block">Menú</a></li>
						<li><a href="{{ route('gallery') }}" class="py-2 d-block">Galería</a></li>
						<li><a href="{{ route('location') }}" class="py-2 d-block">Ubicación</a></li>
						<li><a href="{{ route('carrito.index') }}" class="py-2 d-block">Carrito</a></li>
						@guest
						<li><a href="{{ route('login') }}" class="py-2 d-block"></a>Ingresar</li>
						<li><a href="{{ route('register') }}" class="py-2 d-block"></a>Registrarse</li>
						@else
						@if(Auth::user()->type==1 || Auth::user()->type==2 || Auth::user()->type==3)
						<li><a href="{{ route('admin') }}" class="py-2 d-block">Panel Administrativo</a></li>
						@endif
						<li><a href="{{ route('pago.index') }}" class="py-2 d-block">Mi Carrito</a></li>
						<li><a href="{{ route('logout') }}" class="py-2 d-block" onclick="event.preventDefault(); document.getElementById('logout-form-2').submit();">Cerrar Sesión</a></li>
						<form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						@endguest
					</ul>
				</div>
			</div>
			<div class="col-md-4">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Contactos</h2>
					<p>Prado: Balivian entre La Paz y la Reza<br><strong>Teléfono:</strong> +591 4 4527616<br>Circunvalación y calle Benjamin Guzmán.<br><strong>Teléfono:</strong> +591 4 4225088</p>
					<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-2">
						<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
						<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
					</ul>
				</div>
			</div>
			<div class="col-md">
				<div class="ftco-footer-widget mb-4">
					<h2 class="ftco-heading-2">Noticias</h2>
					<p>Inscríbete de forma totalmente gratuita en el boletín informativo de Maesma y podrá recibir cada mes en su correo electrónico todas las promociones.</p>
					<form action="#" method="POST">
						@csrf
						<div class="row">
							<div class="input-group col-12">
								<input type="type" class="form-control" name="email" placeholder="Correo Electrónico">
							</div>
							<div class="input-group col-12 mt-2">
								<button type="submit" class="btn btn-primary waves-effect waves-dark text-white">Suscribirse</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<p>
					Maesma Pizzería &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | Realizada por <a href="https://www.otterscompany.com" target="_blank">Otters Company</a>
				</p>
			</div>
		</div>
	</div>
</footer>