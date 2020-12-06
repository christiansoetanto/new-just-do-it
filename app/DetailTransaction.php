<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    /**
     * @var mixed
     */
    public $shoe;
    public function shoe(){
        return $this->hasOne(Shoe::class, 'id','shoe_id');
    }
}
