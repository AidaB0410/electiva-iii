<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'dni', 'phone', 'photo', 'slug', 'address', 'email', 'password', 'state', 'type', 'store_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function cashers() {
        return $this->hasMany(Casher::class);
    }

    public function deliveries() {
        return $this->hasMany(DeliveryUser::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
