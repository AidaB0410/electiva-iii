<?php

function state($state) {
	if ($state==2) {
		return '<span class="badge badge-danger">Inactivo</span>';
	} elseif ($state==1) {
		return '<span class="badge badge-success">Activo</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function pay($pay) {
	if ($pay==2) {
		return '<span class="badge badge-danger">Pago Móvil</span>';
	} elseif ($pay==1) {
		return '<span class="badge badge-success">Transferencia</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function saleState($state) {
	if ($state==1) {
		return '<span class="badge badge-success">Preparación En Proceso</span>';
	} 
	elseif ($state==2) {
		return '<span class="badge badge-info">Enviado</span>';
	} 
	elseif ($state==3) {
		return '<span class="badge badge-white">Entregado</span>';
	} 
	elseif ($state==4) {
		return '<span class="badge badge-success">Reembolso</span>';
	} 
	elseif ($state==5) {
		return '<span class="badge badge-dark">Productos Fuera de Linea</span>';
	} 
	elseif ($state==6) {
		return '<span class="badge badge-warning">Error en el pago</span>';
	} 
	elseif ($state==7) {
		return '<span class="badge badge-light">Pago mediante cheque pendiente</span>';
	} 
	elseif ($state==8) {
		return '<span class="badge badge-primary">Pago por transferencia bancaria pendiente</span>';
	} 
	elseif ($state==9) {
		return '<span class="badge badge-secondary">Pago mediante PayPal pendiente</span>';
	} 
	elseif ($state==10) {
		return '<span class="badge badge-success">Pago Aceptado</span>';
	} 
	elseif ($state==11) {
		return '<span class="badge badge-danger">Cancelado</span>';
	} else {
		return '<span class="badge badge-dark">Desconocido</span>';
	}
}

function selectArray($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if ($selected->slug==$array->slug) {
					$select="selected";
					break;
				} else {
					$select="";
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function selectSizesProduct($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if ($selected->slug==$array->slug) {
					$none='class="d-none"';
					break;
				} else {
					$none="";
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$none.'>'.$array->name.'</option>';
	}
	return $selects;
}

function minutes($start, $end) {
	$minutes=(strtotime($start)-strtotime($end))/60;
	$minutes=abs($minutes);
	$minutes=floor($minutes);

	return 30-$minutes;
}

function active($path) {
	return request()->is($path) ? 'active' : '';
}