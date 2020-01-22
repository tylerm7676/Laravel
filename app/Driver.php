<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'address_id', 'sponsoring_org'
    ];

    /**
     * Get system user associated with a driver. This is a 1 to 1 relationship
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

     /**
     * Return the sponsors associated with the driver. This is a m to n relationship.
     */
    public function sponsors(){
        return $this->belongsToMany('App\Sponsor')->withPivot('points_balance');
    }

    public function address(){
	    return $this->hasOne('App\Address', 'id', 'address_id');
    }
}
