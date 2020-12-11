<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'photo'
    ];
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
