@extends('layouts.web')

@section('title', 'Menú')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.css') }}">
@endsection

@section('content')

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    @foreach($categories as $category)
                    @if(count($category->products)>0)
                    <li><a category="{{ $category->name }}" @if($category->name=="Pizzas") class="active text-white" @endif>{{ $category->name }}</a></li>
                    @endif
                    @endforeach
                    <li><a category="all">Todas</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-6 col-lg-3 ftco-animate menu-filter @if($product->category->name!="Pizzas") d-none @endif" category="{{ $product->category->name }}">
                <div class="product">
                    <a href="{{ route('producto', ['slug' => $product->slug]) }}" class="img-prod">
                        <img class="img-fluid" src="{{ asset('/admins/img/products/'.$product->image) }}" alt="{{ $product->name }}">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="{{ route('producto', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h3>
                        <div class="row d-flex justify-content-center">
                            @if($product->category->slug=="promociones")
                            <div class="col-12">
                                <p>{!! $product->description !!}<br></p>
                            </div>
                            @endif
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
<script src="{{ asset('/admins/vendors/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
@endsection