@extends('layouts.auth')

@section('title', 'Registrarse')

@section('content')

<section id="wrapper" class="login-register login-sidebar login-image">
    <div class="login-box card">
        <div class="card-body">
            <form class="form-horizontal form-material mt-md-1 mt-2" action="{{ route('register') }}" method="POST" id="formRegister">
                {{ csrf_field() }}
                <p class="h2 text-center db">REGISTRATE</p>
                <div class="form-group m-t-10 m-b-10">

                    @include('admin.partials.errors')

                    <div class="col-xs-12">
                        <label>Nombre</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Ejm: Juan" value="{{ old('name') }}" autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="form-group m-t-10">
                    <div class="col-xs-12">
                        <label>Apellido</label>
                        <input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Ejm: Lopez" value="{{ old('lastname') }}" autocomplete="lastname">
                    </div>
                </div>

                <div class="form-group m-t-10">
                    <div class="col-xs-12">
                        <label>Correo Electrónico</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required placeholder="{{ 'ejemplo@gmail.com' }}" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group m-t-10">
                    <div class="col-xs-12">
                        <label>Contraseña</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" required name="password" placeholder="********" id="password">
                    </div>
                </div>

                <div class="form-group m-t-10">
                    <div class="col-xs-12">
                        <label>Confirmar Contraseña</label>
                        <input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="********">
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit" action="register">Registarse</button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Ingresa</b></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection