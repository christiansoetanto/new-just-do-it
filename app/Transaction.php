<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function shoe(){
        return $this->belongsToMany('Shoe','detailtransaction','transaction_id','shoe_id');
    }
}
