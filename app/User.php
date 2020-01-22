<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

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

    public function driver() {
        return $this->hasOne('App\Driver');
    }

    public function sponsor() {
        return $this->hasOne('App\Sponsor');
    }

    public function admin() {
	    return $this->hasOne('App\Admin');
    }

    /**
     * Is the user of type driver.
     * 
     * @var bool
     */
    public function isDriver() {
        return $this->type == "driver";
    }

    /**
     * Is the user of type sponsor.
     * 
     * @var bool
     */
    public function isSponsor() {
        return $this->type == "sponsor";
    }

    /**
     * Is the user of type admin.
     * 
     * @var bool
     */
    public function isAdmin() {
        return $this->type == "admin";
    }

    
}
