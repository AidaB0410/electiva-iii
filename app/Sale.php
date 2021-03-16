<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = [
		'slug',
		'user_id',
		'state',
		'reference',
		'type_pay',
		'subtotal',
		'total',
		'phone',
		'lat',
		'lng',
		'address'
	];

	public function store() {
		return $this->belongsTo(Store::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function distance() {
		return $this->belongsTo(Distance::class);
	}

	public function orders() {
		return $this->hasMany(Order::class);
	}

	public function casher() {
		return $this->hasOne(Casher::class);
	}

	public function deliveryUser() {
		return $this->hasOne(DeliveryUser::class);
	}
}