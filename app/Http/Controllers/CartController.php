<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DetailTransaction;
use App\HeaderTransaction;
use App\Shoe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getAddToCart($id){
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        $shoe = Shoe::find($id);
        return view('addToCart', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role]);
    }

    public function postAddToCart(Request $request){

        $request->validate([
            'id'=>'required',
            'quantity'=>'required'
        ]);

        $shoe_id = $request->get('id');
        $qty = $request->get('quantity');

        $user_id = Auth::id();
//        cek ini
        //find dulu shoe id nya,
        //kalau sudah ada, tambah quantity,
        //kalau belum ada, insert baru.
        $x = Cart::where('user_id', $user_id)->where('shoe_id', $shoe_id)->first();
        if($x == null){
            $cart = new Cart([
                'user_id' => $user_id,
                'shoe_id' => $shoe_id,
                'quantity' => $qty
            ]);
            $cart->save();
        }
        else{
            $x->quantity += $qty;
            $x->save();
        }

        //notes untuk COllection(get) pake bla->count(), utk Eloquent(first) pake == null


        return redirect('/shoe');

    }


    public function viewCart(){
        $user_id = Auth::id();
        $carts = Cart::all()->where('user_id', $user_id);
//        dd($carts);
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        if($carts->count() > 0){
            foreach ($carts as $cart){
                $cart->shoe = $cart->shoe()->first();
            }
            return view('cart', ['carts' => $carts, 'auth'=>$auth,'role'=>$role]);
        }

        return view('cart', ['carts' => 'null', 'auth'=>$auth,'role'=>$role]);
    }

    public function checkoutCart(){
        $user_id = Auth::id();
        $carts = Cart::all()->where('user_id', $user_id);
        $total_price = 0;
        foreach($carts as $cart){
            $cart->shoe = $cart->shoe()->first();
            $total_price += $cart->shoe->price;
        }


        $header_transaction = new HeaderTransaction();
        $header_transaction->user_id = $user_id;
        $header_transaction->total_price = $total_price;
        $header_transaction->transaction_date = Carbon::now();;
        $header_transaction->save();
        $header_id = $header_transaction->id;

        foreach($carts as $cart){
            $detail_transaction = new DetailTransaction();
            $detail_transaction->header_transaction_id = $header_id;
            $detail_transaction->shoe_id = $cart->shoe->id;
            $detail_transaction->quantity = $cart->quantity;
            $detail_transaction->save();
            $cart->delete();
        }
        return redirect('/shoe');


    }

    public function geteditCart($id){
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        $user_id = Auth::id();
        $shoe = Shoe::find($id);
        $cart = Cart::where('user_id',$user_id)->where('shoe_id',$id)->first();
        return view('editCart', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role,'cart'=>$cart]);
    }

    public function postupdateeditcart(Request $request){
        $request->validate([
            'id'=>'required',
            'quantity'=>'required'
        ]);
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->where('shoe_id', $request->get('id'))->first();
//        dd($cart);
        if($cart == null) return redirect()->route('cart');
        else{
            $cart->quantity = $request->get('quantity');
            $cart->save();
        }
        return redirect('/viewCart');

    }

    public function postdeleteeditcart(Request $request){
        $request->validate([
            'id'=>'required'
        ]);
        $cart = Cart::find($request->get('id'));
        $cart->delete();
        return redirect('/viewCart');
    }

}
