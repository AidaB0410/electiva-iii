@component('mail::message')

<link rel="stylesheet" type="text/css" href="{{ asset('/web/css/style.css') }}">

# Hola

Ha sido realizado un nuevo pedido de {{ $user->name." ".$user->lastname }}.
<br>
@if($sale->lat!=NULL && $sale->lng!=NULL && $type==1)
Puede comunicarse con el cliente por medio de la información suminitrada:
<br>
Télefono: {{ $user->phone_customer }}
<br>
Correo electrónico: {{ $user->email }}
<br>
El pedido debe ser enviado a: {{ $user->address }}
<div class="text-center">
	<a href="{{ 'https://www.google.co.ve/maps/@'.$sale->lat.','.$sale->lng.',6z' }}" target="_blank" class="btn btn-primary">Ver en Google Maps</a>
</div>
<br>
@endif

# Detalles del Pedido

<table class="table table-bordered w-100">
	<thead>
		<tr>
			<th>#</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sale->orders as $product)
		<tr>
			<td class="px-2">{{ $num++ }}</td>
			<td class="px-2">{{ $product->product->name }}<br>({{ $product->size->name }})</td>
			<td class="px-2">{{ $product->qty }}</td>
			<td class="px-2">{{ number_format($product->price*$product->qty, 2, ",", ".")." Bs" }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<br>

# Subtotal: {{ number_format($sale->subtotal, 2, ",", ".")." Bs" }}
# Delivery: {{ number_format($sale->delivery, 2, ",", ".")." Bs" }}
# Total: {{ number_format($sale->total, 2, ",", ".")." Bs" }}

Saludos,<br>
{{ config('app.name') }}

@endcomponent
