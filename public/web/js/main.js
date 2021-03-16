 (function($) {

 	"use strict";

 	$('[data-toggle="tooltip"]').tooltip();

 	var isMobile = {
 		Android: function() {
 			return navigator.userAgent.match(/Android/i);
 		},
 		BlackBerry: function() {
 			return navigator.userAgent.match(/BlackBerry/i);
 		},
 		iOS: function() {
 			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
 		},
 		Opera: function() {
 			return navigator.userAgent.match(/Opera Mini/i);
 		},
 		Windows: function() {
 			return navigator.userAgent.match(/IEMobile/i);
 		},
 		any: function() {
 			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
 		}
 	};

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
		console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
			st = $w.scrollTop(),
			navbar = $('.ftco_navbar'),
			sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	
	var counter = function() {
		
		$('#section-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
					num = $this.data('number');
					console.log(num);
					$this.animateNumber(
					{
						number: num,
						numberStep: comma_separator_number_step
					}, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();

	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function() {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function(e) {
			e.preventDefault();

			var hash = this.hash,
			navToggler = $('.navbar-toggler');
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 700, 'easeInOutExpo', function(){
				window.location.hash = hash;
			});


			if ( navToggler.is(':visible') ) {
				navToggler.click();
			}
		});
		$('body').on('activate.bs.scrollspy', function () {
			console.log('nice');
		})
	};
	OnePageNav();

	var goHere = function() {

		$('.mouse-icon').on('click', function(event){
			
			event.preventDefault();

			$('html,body').animate({
				scrollTop: $('.goto-here').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});
	};
	goHere();

	if ($(".promos-carousel").length) {
		$(".promos-carousel").owlCarousel({
			autoplay: true,
			dots: true,
			loop: true,
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 1
				},
				900: {
					items: 2
				}
			}
		});
	}

})(jQuery);

$(document).ready(function() {
	//Validación para introducir solo números
	$('.number, .phone, #dni').keypress(function() {
		return event.charCode >= 48 && event.charCode <= 57;
	});
    //Validación para introducir solo letras y espacios
    $('#name, #lastname').keypress(function() {
    	return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
    });
    //Validación para solo presionar enter y borrar
    $('.date').keypress(function() {
    	return event.charCode == 32 || event.charCode == 127;
    });

	//multiselect
	if ($('.multiselect').length) {
		$('.multiselect').select2({
			theme: "bootstrap",
			language: "es"
		});
	}

	//Variables con fecha actual
	var mayor=new Date();
	//Restandole 18 años a la fecha actual
	mayor.setMonth(mayor.getMonth() - 216);

	//datepicker material
	if ($('.date').length) {
		$('.date').bootstrapMaterialDatePicker({
			time: false,
			cancelText: 'Cancelar',
			clearText: 'Limpiar',
			format: 'DD-MM-YYYY',
			maxDate : mayor
		});
	}

	//datatable español
	var español = {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún resultado disponible en esta tabla",
		"sInfo":           "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "No hay resultados",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar :",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	}

	//datatable normal
	if ($('#tabla').length) {
		$('#tabla').DataTable({
			"language": español
		});
	}

	//touchspin para los campos numericos
	if ($('.number').length) {
		$(".number").TouchSpin({
			min: 1,
			max: 99999999999,
			buttondown_class: 'btn btn-primary rounded',
			buttonup_class: 'btn btn-primary rounded'
		});
	}

	if ($('.qty').length) {
		$(".qty").each(function(){
			$(this).TouchSpin({
				min: 1,
				buttondown_class: 'btn btn-primary px-2 py-1 rounded',
				buttonup_class: 'btn btn-primary px-2 py-1 rounded'
			});
		});
	}

	//Mapa de leaflet
	if ($('#lat').length && $('#lng').length && $('#map').length) {
		if ($('#lat').val()=="" || $('#lng').val()=="") {
			var map = L.map('map', {
				center: [-17.3779267,-66.1455536],
				zoom: 8
			});

			marker = L.marker([-17.3779267,-66.1455536]).addTo(map);
		} else {
			var mapLat=$('#lat').val();
			var mapLng=$('#lng').val();
			var map = L.map('map', {
				center: [mapLat, mapLng],
				zoom: 8
			});

			marker = L.marker([mapLat, mapLng]).addTo(map);
		}

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		map.on('click', function(e) {
			if (marker) {
				map.removeLayer(marker);
			}

			marker=L.marker(e.latlng).addTo(map);
			$('#lat').val(e.latlng.lat);
			$('#lng').val(e.latlng.lng);

			lat=$('#lat').val(), 
			lng=$('#lng').val();
		});
	}
});

//Abrir producto en el modal
$('.btn-cart-open').click(function(event) {
	var slug=$(this).attr('slug'), img=$(this).attr('image');
	$.ajax({
		url: '/carrito/producto',
		type: 'POST',
		dataType: 'json',
		data: {slug: slug},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.status) {
			$('#select-size-cart option').remove();
			for (var i=obj.product.sizes.length-1; i>=0; i--) {
				$('#select-size-cart').append($('<option>', {
					value: obj.product.sizes[i].slug,
					text: obj.product.sizes[i].name+" - "+new Intl.NumberFormat("de-DE").format(obj.product.sizes[i].pivot.price)+" Bs",
					price: obj.product.sizes[i].pivot.price
				}));
			}

			var stores="";
			for (var i=obj.product.stores.length-1; i>=0; i--) {
				if (obj.product.stores.length-1>i) {
					stores+=" / ";
				}
				stores+=obj.product.stores[i].name;
			}

			$('#stores-product-cart p').text(stores);
			$('#title-cart').text(obj.product.name);
			$('#description-cart').html(obj.product.description);
			$('#img-cart').attr('src', img);
			var price=new Intl.NumberFormat("de-DE").format($('#select-size-cart option:selected').attr('price'));
			$('#price-add-cart').text(price+" Bs");
			$('#btn-add-cart').attr('slug', obj.product.slug);
			$('input[name="qty"]').val(1);
			$('input[name="qty"]').attr('price', $('#select-size-cart option:selected').attr('price'));
			$('#modal-cart').modal();
		} else {
			Lobibox.notify('error', {
				iconSource: 'icon',
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	});
});

//Cambiar el precio en el carrito si se cambia el tamaño del producto
$('#select-size-cart').change(function(event) {
	var qty=$('input[name="qty"]').val(), price=$('#select-size-cart option:selected').attr('price');
	var total=price*qty;
	var total=new Intl.NumberFormat("de-DE").format(total);
	$('#price-add-cart').text(total+" Bs");
	$('input[name="qty"]').attr('price', price);
});

//Al cambiar la cantidad de un producto en el carrito en el modal cambia el total
$('#modal-qty').change(function() {
	var price=$(this).attr('price'), qty=$(this).val();
	var total=price*qty;
	total=new Intl.NumberFormat("de-DE").format(total);
	$('#price-add-cart').text(total+" Bs");
});

$('#modal-qty').keyup(function() {
	var price=$(this).attr('price'), qty=$(this).val();
	var total=price*qty;
	total=new Intl.NumberFormat("de-DE").format(total);
	$('#price-add-cart').text(total+" Bs");
});

//Agregar producto del carrito
$('#btn-add-cart').click(function(event) {
	var qty=$('input[name="qty"]').val(), slug=$(this).attr('slug'), size=$('#select-size-cart').val();
	$.ajax({
		url: '/carrito/agregar',
		type: 'POST',
		dataType: 'json',
		data: {qty: qty, slug: slug, size: size},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.status) {
			$(".count-cart").text(obj.cart.length);
			$('#modal-cart').modal('hide');
			Lobibox.notify('success', {
				iconSource: 'icon',
				title: 'Producto agregado',
				sound: true,
				msg: 'El producto a sido agregado al carrito exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				iconSource: 'icon',
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	});
});

//Quitar producto del carrito
$('.product-remove a').click(function() {
	var code=$(this).attr('code');
	$.ajax({
		url: '/carrito/quitar',
		type: 'POST',
		dataType: 'json',
		data: {code: code},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	}).done(function(obj) {
		if (obj.status) {
			$(".cartProduct[code='"+code+"']").remove();
			var count=$(".count-cart").text();
			count=count-1;
			$(".count-cart").text(count);
			Lobibox.notify('success', {
				iconSource: 'icon',
				title: 'Producto eliminado',
				sound: true,
				msg: 'El producto a sido sacado del carrito exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				iconSource: 'icon',
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	});
});

//Al cambiar la cantidad de un producto en el carrito cambia el total
$('.qty').change(function() {
	var code=$(this).attr('code'), slug=$(this).attr('slug'), size=$(this).attr('size'), price=$(this).attr('price'), qty=$(this).val();
	$.ajax({
		url: '/carrito/cantidad',
		type: 'POST',
		dataType: 'json',
		data: {qty: qty, slug: slug, size: size, code: code},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.status) {
			$('.total[code="'+code+'"]').text(obj.subtotal+" Bs");
			var total=0;
			$(".qty").each(function(){
				$(this).attr('price');
				var price=$(this).attr('price'), qty=$(this).val();
				var subtotal=price*qty;
				total+=subtotal;
			});
			total=new Intl.NumberFormat("de-DE").format(total);
			$('#total-cart').text(total+" Bs");
		} else {
			Lobibox.notify('error', {
				iconSource: 'icon',
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	});
});

$('.qty').keyup(function() {
	var code=$(this).attr('code'), price=$(this).attr('price'), qty=$(this).val();
	$.ajax({
		url: '/carrito/cantidad',
		type: 'POST',
		dataType: 'json',
		data: {qty: qty, code: code},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.status) {
			$('.total[code="'+code+'"]').text(obj.subtotal+" Bs");
			var total=0;
			$(".qty").each(function(){
				$(this).attr('price');
				var price=$(this).attr('price'), qty=$(this).val();
				var subtotal=price*qty;
				total+=subtotal;
			});
			total=new Intl.NumberFormat("de-DE").format(total);
			$('#total-cart').text(total+" Bs");
		} else {
			Lobibox.notify('error', {
				iconSource: 'icon',
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	});
});

$('.product-category a').click(function(event) {
	$('.product-category a').removeClass('active');
	$('.product-category a').removeClass('text-white');
	$(this).addClass('active');
	$(this).addClass('text-white');
	var filter=$(this).attr('category');
	if (filter=="all") {
		$('.menu-filter').removeClass('d-none');
	} else {
		$('.menu-filter').each(function(index, el) {
			if ($(this).attr('category')==filter) {
				$(this).removeClass('d-none');
			} else {
				$(this).addClass('d-none');
			}
		});
	}
});

//Cambiar el precio en el carrito si se cambia el tamaño del producto en la vista de producto
$('#select-product-size-cart').change(function(event) {
	var qty=$('#product-qty').val(), price=$('#select-product-size-cart option:selected').attr('price');
	var total=price*qty;
	var total=new Intl.NumberFormat("de-DE").format(total);
	$('#price-product-add-cart').text(total+" Bs");
	$('#product-qty').attr('price', price);
});

//Al cambiar la cantidad de un producto en el carrito cambia el total desde la vista de producto
$('#product-qty').change(function() {
	var price=$(this).attr('price'), qty=$(this).val();
	var total=price*qty;
	total=new Intl.NumberFormat("de-DE").format(total);
	$('#price-product-add-cart').text(total+" Bs");
});

$('#product-qty').keyup(function() {
	var price=$(this).attr('price'), qty=$(this).val();
	var total=price*qty;
	total=new Intl.NumberFormat("de-DE").format(total);
	$('#price-product-add-cart').text(total+" Bs");
});

//Agregar producto del carrito desde vista de producto
$('#btn-add-product-cart').click(function(event) {
	var qty=$('#product-qty').val(), slug=$(this).attr('slug'), size=$('#select-product-size-cart').val();
	$.ajax({
		url: '/carrito/agregar',
		type: 'POST',
		dataType: 'json',
		data: {qty: qty, slug: slug, size: size},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.status) {
			$(".count-cart").text(obj.cart.length);
			$('#product-qty').val(1);
			Lobibox.notify('success', {
				iconSource: 'icon',
				title: 'Producto agregado',
				sound: true,
				msg: 'El producto a sido agregado al carrito exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				iconSource: 'icon',
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	});
});

$('#delivery').change(function(event) {
	if ($(this).val()!="") {
		var delivery=$('#delivery option:selected').attr('price'), total=$('#total').attr('total');
		if ($(this).val()!="local-gratis") {
			$('#deliveryMap').removeClass('d-none');
		} else {
			$('#deliveryMap').addClass('d-none');
		}
		var totalDelivery=new Intl.NumberFormat("de-DE").format(delivery);
		total=parseFloat(total, 10)+parseFloat(delivery, 10);
		total=new Intl.NumberFormat("de-DE").format(total);
		$('#total-delivery').text(totalDelivery+' Bs');
		$('#total').text(total+' Bs');
	} else {
		$('#deliveryMap').addClass('d-none');
		var total=$('#total').attr('total');
		total=new Intl.NumberFormat("de-DE").format(total);
		$('#total-delivery').text('0,00 Bs');
		$('#total').text(total+' Bs');
	}
});