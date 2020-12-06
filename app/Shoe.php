<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
