<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryUser extends Model
{
    protected $table = 'delivery_user';

    protected $fillable = ['sale_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
