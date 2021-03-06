<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'shoe_id', 'quantity',
    ];
    /**
     * @var mixed
     */
    private $user_id;
    public $shoe;
    public function shoe(){
        return $this->hasOne(Shoe::class, 'id','shoe_id');
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
