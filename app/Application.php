<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function driver(){
        return $this->hasOne('App\Driver', 'id', 'driver_id');
    }
}
