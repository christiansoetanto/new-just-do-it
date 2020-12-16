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
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $user_id = Auth::id();
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        //jika member maka transaction diampilkan hanya user tersebut
        if($role == 'member'){
            $header_transactions = HeaderTransaction::where('user_id', $user_id)->get();
        }
        //jika admin, maka semuaa transaction dari user akan ditampilkan
        else if($role == 'admin'){
            $header_transactions = HeaderTransaction::all();
        }
        //mengecek apakan header null atau tidak
        if($header_transactions != null){
            //jika tidak null, akan diloop sebanyak header dan masing2 header akan di loop sebanyak detail yang ada
            foreach ($header_transactions as $head){
                $head->detail_transaction = $head->detail_transaction()->get();
                foreach($head->detail_transaction as $detail){
                    $detail->shoe = $detail->shoe()->first();
                }
            }
            return view('transaction', ['transactions' => $header_transactions,'auth'=>$auth,'role'=>$role]);
        }

        return view('transaction', ['transactions' => 'null','auth'=>$auth,'role'=>$role]);
    }

}
