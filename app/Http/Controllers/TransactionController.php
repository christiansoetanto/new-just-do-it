<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
            $transaction = Transaction::all();
//            dd($shoes);
            return view('transaction', ['transaction' => $transaction]);

    }

}