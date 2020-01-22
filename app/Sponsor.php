<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sponsor;

class Sponsor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'organization'
    ];

    /**
     * Get system user associated with a sponsor. This is a 1 to 1 relationship
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function items() {
        return $this->hasMany('App\Item', 'sponsor_id');
    }

    public function drivers() {
        return $this->belongsToMany('App\Driver');
    }
}
