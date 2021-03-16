<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = [
		'sale_id',
		'product_id',
		'size_id',
		'price',
		'qty'
	];

	public function product() {
        return $this->belongsTo(Product::class);
    }

    public function size() {
        return $this->belongsTo(Size::class);
    }

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function store() {
        return $this->belongsTo(Store::class);
    }
}
