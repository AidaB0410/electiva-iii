<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'description', 'type', 'state', 'user_id'];

	public function user()
    {
        return $this->belongsTo(User::class);
    }
}
