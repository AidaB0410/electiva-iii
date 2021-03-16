<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light shadow" id="ftco-navbar">
	<a class="navbar-brand ml-2" href="{{ route('home') }}">tAmo's</a>
	<div>
		<a class="d-xl-none d-lg-none pl-5" href="{{ route('carrito.index') }}"><i class="icon-shopping_cart"></i>[<span class="count-cart">{{ $cart }}</span>]</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>
	</div>

	<div class="collapse navbar-collapse" id="ftco-nav">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item {{ active('/') }}"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>
			<li class="nav-item {{ active('menu') }}"><a href="{{ route('menu') }}" class="nav-link">Menú</a></li>
			<li class="nav-item {{ active('carrito') }} cta cta-colored"><a href="{{ route('carrito.index') }}" class="nav-link"><span class="icon-shopping_cart"></span>[<span class="count-cart">{{ $cart }}</span>]</a></li>
			@guest
			<li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Ingresar</a></li>
			<li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrarse</a></li>
			@else
			<li class="nav-item {{ active('mis-compras') }} dropdown">
				<a class="nav-link dropdown-toggle" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
				<div class="dropdown-menu" aria-labelledby="dropdown05">
					@if(Auth::user()->type==1 || Auth::user()->type==2 || Auth::user()->type==3)
					<a class="dropdown-item" href="{{ route('admin') }}">Panel Administrativo</a>
					@endif
					<a class="dropdown-item {{ active('mis-compras') }}" href="{{ route('pago.index') }}">Mis Compras</a>
					<hr class="w-75 my-0">
					<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
			@endguest
		</ul>
	</div>
</nav>