<?php

namespace App\Http\Controllers;

use App\HeaderTransaction;
use App\DetailTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function viewTrans(){
        $user_id = Auth::id();
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        if($role == 'member'){
            $header_transactions = HeaderTransaction::where('user_id', $user_id)->get();
        }
        else if($role == 'admin'){
            $header_transactions = HeaderTransaction::all();
        }
//        dd($header_transactions);
        if($header_transactions != null){

            foreach ($header_transactions as $head){
                $head->detail_transaction = $head->detail_transaction()->get();
                foreach($head->detail_transaction as $detail){
                    $detail->shoe = $detail->shoe()->first();
                }
            }
            return view('transaction', ['transactions' => $header_transactions,'auth'=>$auth,'role'=>$role]);
        }

//        dd($header_transactions);
        return view('transaction', ['transactions' => 'null','auth'=>$auth,'role'=>$role]);
    }

}
