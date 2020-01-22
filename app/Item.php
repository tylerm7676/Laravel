<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function sponsor() {
        return $this->belongsTo('App\Sponsor','sponsor_id');
    }
}
