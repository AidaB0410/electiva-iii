<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casher extends Model
{
    protected $fillable = ['sale_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }
}
