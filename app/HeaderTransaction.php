<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    /**
     * @var mixed
     */
    public $detail_transaction;

    public function detail_transaction(){
        return $this->hasMany(DetailTransaction::class, 'header_transaction_id');
    }
}
