$(document).ready(function(){
	//Usuarios register
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Usuarios register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191,
					remote: {
						url: "/registro/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Usuarios
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 8,
					maxlength: 191,
					remote: {
						url: "/registro/email",
						type: "get"
					}
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				dni: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Categorias
	$("button[action='category']").on("click",function(){
		$("#formCategory").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Ventas
	$("button[action='sale']").on("click",function(){
		$("#formSale").validate({
			rules:
			{
				store_id: {
					required: true
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				distance_id: {
					required: true
				}
			},
			messages:
			{
				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},
				store_id: {
					required: 'Seleccione una opción.'
				},
				distance_id: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Productos
	$("button[action='store']").on("click",function(){
		$("#formStore").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone_one: {
					required: true,
					minlength: 2,
					maxlength: 15
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone_two: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Tienda
	$("button[action='product']").on("click",function(){
		$("#formProduct").validate({
			rules:
			{
				store_id: {
					required: true
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},


				price_unique: { 
					required: true,
					min: 0,
					max: 10000000
				},

				description: { 
					required: true,
					minlength: 10,
					maxlength: 64000
				}
			},
			messages:
			{
				store_id: {
					required: 'Seleccione una opción.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				price_unique: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			}
		});
	});

	//Slider
	$("button[action='slider']").on("click",function(){
		$("#formSlider").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Paginas
	$("button[action='page']").on("click",function(){
		$("#formPage").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Galleria
	$("button[action='gallery']").on("click",function(){
		$("#formGallery").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Servicio
	$("button[action='service']").on("click",function(){
		$("#formService").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Slider Edit
	$("button[action='sliderEdit']").on("click",function(){
		$("#formSliderEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: false
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Paginas Edit
	$("button[action='pageEdit']").on("click",function(){
		$("#formPageEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: false
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			}
		});
	});

	//Galleria Edit
	$("button[action='galleryEdit']").on("click",function(){
		$("#formGalleryEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 10,
					maxlength: 64000
				},

				link: {
					required: true,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: false
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				link: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			}
		});

		//Servicio
		$("button[action='serviceEdit']").on("click",function(){
			$("#formServiceEdit").validate({
				rules:
				{
					title: {
						required: true,
						minlength: 2,
						maxlength: 191
					},

					description: {
						required: true,
						minlength: 10,
						maxlength: 64000
					},

					link: {
						required: true,
						minlength: 3,
						maxlength: 191
					},

					state: {
						required: true
					},

					image: {
						required: false
					}
				},
				messages:
				{
					title: {
						minlength: 'Escribe mínimo {0} caracteres.',
						maxlength: 'Escribe máximo {0} caracteres.'
					},

					description: {
						minlength: 'Escribe mínimo {0} caracteres.',
						maxlength: 'Escribe máximo {0} caracteres.'
					},

					link: {
						minlength: 'Escribe mínimo {0} caracteres.',
						maxlength: 'Escribe máximo {0} caracteres.'
					},

					state: {
						required: 'Seleccione una opción.'
					}
				}
			});
		});
	});
});