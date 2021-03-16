@extends('layouts.web')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/admins/vendors/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

@section('content')

<section id="home-section" class="hero">
    <div class="home-slider owl-carousel-banner banner-height">
        @if(count($sliders)>1)
        <div id="carouselCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($sliders as $slider)
                <li data-target="#carouselCaptions" data-slide-to="{{ $loop->index }}" @if($loop->index==0) class="active" @endif></li>
                @endforeach
            </ol>
            <div class="carousel-inner banner-height">
                @foreach($sliders as $slider)
                <div class="carousel-item slider-item banner-height @if($loop->index==0) active @endif" style="background-image: url('/admins/img/sliders/{{ $sliders[0]->image }}');">
                    <div class="overlay"></div>
                    <div class="carousel-caption row slider-text justify-content-center align-items-center banner-height">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">{{ $slider->title }}</h1>
                            <h2 class="subheading mb-4">{{ $slider->description }}</h2>
                            <p><a href="{{ $slider->link }}" class="btn btn-primary">Ver Más</a></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        @elseif(count($sliders)==1)
        <div class="slider-item banner-height" style="background-image: url('/admins/img/sliders/{{ $sliders[0]->image }}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center banner-height" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">{{ $sliders[0]->title }}</h1>
                        <h2 class="subheading mb-4">{{ $sliders[0]->description }}</h2>
                        <p><a href="{{ $sliders[0]->link }}" class="btn btn-primary">Ver Más</a></p>
                    </div>

                </div>
            </div>
        </div>
        @else
        <div class="slider-item banner-height" style="background-image: url(web/images/bg_2.jpg);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center banner-height" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2">Los Mejores Productos</h1>
                        <h2 class="subheading mb-4">Para los mejores clientes</h2>
                        <p><a href="{{ route('menu') }}" class="btn btn-primary">Ver Más</a></p>
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<section class="ftco-section ftco-no-pb">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-lg-4 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Envíos a tiempo</h3>
                        <span>Hasta la comodidad de tu hogar</span>
                    </div>
                </div>      
            </div>
            <div class="col-lg-4 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Calidad Superior</h3>
                        <span>Productos de Calidad</span>
                    </div>
                </div>      
            </div>
            <div class="col-lg-4 col-md-3 col-6 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Pedidos</h3>
                        <span>Tratos coridales por parte de nuestros empleados</span>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Nuestros Mejores Productos</span>
                <h2 class="mb-4">Más Destacados</h2>
            </div>
        </div>   		
    </div>
    <div class="container">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="{{ route('producto', ['slug' => $product->slug]) }}" class="img-prod">
                        <img class="img-fluid" src="{{ asset('/admins/img/products/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="{{ route('producto', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h3>
                        <div class="row d-flex justify-content-center">
                            <a href="{{ route('producto', ['slug' => $product->slug]) }}" class="btn btn-primary">
                                <span><i class="ion-ios-menu"></i></span>
                            </a>
                            <a class="btn btn-primary btn-cart-open mx-1" slug="{{ $product->slug }}" image="{{ asset('/admins/img/products/'.$product->image) }}">
                                <span><i class="ion-ios-cart"></i></span>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



<div class="modal fade" id="modal-cart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title-cart"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <img src="" class="w-100 img-fluid" id="img-cart">
                    </div>
                    <div class="col-12">
                        <p id="description-cart"></p>
                    </div>
                    <div class="form-group col-12" id="stores-product-cart">
                        <label class="col-form-label">Disponible En:</label>
                        <p></p>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Tamaño</label>
                        <select class="form-control" name="size" id="select-size-cart">
                            <option value="">Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label class="col-form-label">Cantidad</label>
                        <input type="text" class="form-control number" name="qty" placeholder="Introduzca una cantidad" min="1" value="1" id="modal-qty" price="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-add-cart" slug=""><b id="price-add-cart"></b> Agregar Al Carrito</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('/admins/vendors/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
@endsection