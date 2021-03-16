<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes();
Route::get('/registro/email', 'UserController@emailVerify');

///////////////////////////////////////////// WEB ////////////////////////////////////////////////

// Inicio
Route::get('/', 'WebController@index')->name('home');
Route::get('/nosotros', 'WebController@about')->name('about');
Route::get('/servicios', 'WebController@services')->name('services');
Route::get('/galeria', 'WebController@gallery')->name('gallery');
Route::get('/ubicacion', 'WebController@location')->name('location');

//Tienda
Route::get('/menu', 'WebController@menu')->name('menu');
Route::get('/producto/{slug}', 'WebController@product')->name('producto');

//Pedidos
Route::get('/carrito', 'WebController@cart')->name('carrito.index');
Route::post('/carrito/producto', 'WebController@addProduct')->name('carrito.add.product');
Route::post('/carrito/agregar', 'WebController@addCart')->name('carrito.add');
Route::post('/carrito/quitar', 'WebController@removeCart')->name('carrito.remove');
Route::post('/carrito/cantidad', 'WebController@qtyCart')->name('carrito.qty');
Route::get('/pedido/{slug}', 'OrderController@show')->name('pedido.show');

//Pagos
Route::get('/comprar', 'WebController@checkout')->name('pago.create');
Route::post('/comprar', 'WebController@saleStore')->name('pago.store');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/mis-compras', 'WebController@shopping')->name('pago.index');
	Route::get('/mis-compras/{slug}', 'WebController@orderProduct')->name('pago.order');

	///// //////////////////////////////////ADMIN ///////////////////////////////////////////////////

	Route::group(['middleware' => ['not.client']], function () {
		// Inicio
		Route::get('/tamos', 'AdminController@index')->name('admin');
	});

	Route::group(['middleware' => ['admin']], function () {
		
		//Productos
		Route::get('/tamos/productos', 'ProductController@index')->name('productos.index');
		Route::get('/tamos/productos/registrar', 'ProductController@create')->name('productos.create');
		Route::post('/tamos/productos', 'ProductController@store')->name('productos.store');
		Route::get('/tamos/productos/{slug}/editar', 'ProductController@edit')->name('productos.edit');
		Route::put('/tamos/productos/{slug}', 'ProductController@update')->name('productos.update');
		Route::delete('/tamos/productos/eliminar/{slug}', 'ProductController@destroy')->name('productos.delete');

		//Categorías
		Route::get('/tamos/categorias', 'CategoryController@index')->name('categorias.index');
		Route::get('/tamos/categorias/registrar', 'CategoryController@create')->name('categorias.create');
		Route::post('/tamos/categorias', 'CategoryController@store')->name('categorias.store');
		Route::get('/tamos/categorias/{slug}', 'CategoryController@show')->name('categorias.show');
		Route::get('/tamos/categorias/{slug}/editar', 'CategoryController@edit')->name('categorias.edit');
		Route::put('/tamos/categorias/{slug}', 'CategoryController@update')->name('categorias.update');
		Route::delete('/tamos/categorias/eliminar/{slug}', 'CategoryController@destroy')->name('categorias.delete');

		//Tiendas
		Route::get('/tamos/tiendas', 'StoreController@index')->name('tienda.index');
		Route::get('/tamos/tiendas/registrar', 'StoreController@create')->name('tienda.create');
		Route::post('/tamos/tiendas', 'StoreController@store')->name('tienda.store');
		Route::get('/tamos/tiendas/{slug}/editar', 'StoreController@edit')->name('tienda.edit');
		Route::put('/tamos/tiendas/{slug}', 'StoreController@update')->name('tienda.update');
		Route::put('/tamos/tiendas/activar/{slug}', 'StoreController@activate')->name('tienda.activate');
		Route::put('/tamos/tiendas/desactivar/{slug}', 'StoreController@desactivate')->name('tienda.desactivate');

		//Usuarios
		Route::get('/tamos/usuarios', 'UserController@index')->name('usuario.index');
		Route::get('/tamos/usuarios/registrar', 'UserController@create')->name('usuario.create');
		Route::post('/tamos/usuarios', 'UserController@store')->name('usuario.store');
		Route::get('/tamos/usuarios/inactivos', 'UserController@inactive')->name('usuario.inactivos');
		Route::get('/tamos/usuarios/{slug}', 'UserController@show')->name('usuario.show');
		Route::get('/tamos/usuarios/{slug}/editar', 'UserController@edit')->name('usuario.edit');
		Route::put('/tamos/usuarios/{slug}', 'UserController@update')->name('usuario.update');
		Route::put('/tamos/usuarios/activar/{slug}', 'UserController@activate')->name('usuario.activate');
		Route::put('/tamos/usuarios/desactivar/{slug}', 'UserController@deactivate')->name('usuario.deactivate');

		//Distancias
		Route::get('/tamos/distancias', 'DistanceController@index')->name('distancias.index');
		Route::get('/tamos/distancias/registrar', 'DistanceController@create')->name('distancias.create');
		Route::post('/tamos/distancias', 'DistanceController@store')->name('distancias.store');
		Route::get('/tamos/distancias/{slug}/editar', 'DistanceController@edit')->name('distancias.edit');
		Route::put('/tamos/distancias/{slug}', 'DistanceController@update')->name('distancias.update');
		Route::delete('/tamos/distancias/eliminar/{slug}', 'DistanceController@destroy')->name('distancias.delete');

		//Pagina Nosotros
		Route::get('/tamos/paginas', 'PageController@index')->name('paginas.index');
		Route::get('/tamos/paginas/registrar', 'PageController@create')->name('paginas.create');
		Route::post('/tamos/paginas', 'PageController@store')->name('paginas.store');
		Route::get('/tamos/paginas/{slug}/editar', 'PageController@edit')->name('paginas.edit');
		Route::put('/tamos/paginas/{slug}', 'PageController@update')->name('paginas.update');
		Route::delete('/tamos/paginas/eliminar/{slug}', 'PageController@destroy')->name('paginas.delete');

		//Servicios
		Route::get('/tamos/servicios', 'ServiceController@index')->name('servicios.index');
		Route::get('/tamos/servicios/registrar', 'ServiceController@create')->name('servicios.create');
		Route::post('/tamos/servicios', 'ServiceController@store')->name('servicios.store');
		Route::get('/tamos/servicios/{slug}/editar', 'ServiceController@edit')->name('servicios.edit');
		Route::put('/tamos/servicios/{slug}', 'ServiceController@update')->name('servicios.update');
		Route::delete('/tamos/servicios/eliminar/{slug}', 'ServiceController@destroy')->name('servicios.delete');

		//Sliders
		Route::get('/tamos/sliders', 'SliderController@index')->name('sliders.index');
		Route::get('/tamos/sliders/registrar', 'SliderController@create')->name('sliders.create');
		Route::post('/tamos/sliders', 'SliderController@store')->name('sliders.store');
		Route::get('/tamos/sliders/{slug}/editar', 'SliderController@edit')->name('sliders.edit');
		Route::put('/tamos/sliders/{slug}', 'SliderController@update')->name('sliders.update');
		Route::delete('/tamos/sliders/eliminar/{slug}', 'SliderController@destroy')->name('sliders.delete');

		//Galeria
		Route::get('/tamos/galeria', 'GalleryController@index')->name('galeria.index');
		Route::get('/tamos/galeria/registrar', 'GalleryController@create')->name('galeria.create');
		Route::post('/tamos/galeria', 'GalleryController@store')->name('galeria.store');
		Route::get('/tamos/galeria/{slug}/editar', 'GalleryController@edit')->name('galeria.edit');
		Route::put('/tamos/galeria/{slug}', 'GalleryController@update')->name('galeria.update');
		Route::delete('/tamos/galeria/eliminar/{slug}', 'GalleryController@destroy')->name('galeria.delete');
	});

	Route::group(['middleware' => ['not.client']], function () {
		//Ventas
		Route::get('/tamos/ventas', 'SaleController@index')->name('venta.index');
		Route::post('/tamos/ventas/cajero-repartidor/{slug}', 'SaleController@update')->name('venta.user');
		Route::put('/tamos/ventas/tiempo/{slug}', 'SaleController@time')->name('venta.time');
		Route::put('/tamos/ventas/estado/{slug}', 'SaleController@state')->name('venta.state');
		Route::get('/tamos/ventas/{slug}', 'SaleController@show')->name('venta.show');

		//Notificaciones
		Route::post('/notificaciones/agregar', 'AdminController@addNotifications')->name('notificaciones.add');
		Route::post('/notificaciones/abrir', 'AdminController@openNotifications')->name('notificaciones.open');
	});
});