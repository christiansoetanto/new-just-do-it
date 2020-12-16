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
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        //halaman addtoCart juga memerlukan detail dari sepatu sehingga kita harus mendapatkan detail dari 1 sepatu berdasarkan id
        $shoe = Shoe::find($id);
        //akan di return ke blade addToCart dengan mengirimkan shoe detail, status login dan role untuk navbar dan sidebar
        return view('addToCart', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role]);
    }

    public function postAddToCart(Request $request){
        //function ini digunakan ketika user ingin addtocart sepatu berdasarkan quantity yang dimasukkan
        //awalnya kita melakukan validasi terhadap inputan user dimana id dan quantity sepatu harus ada
        $request->validate([
            'id'=>'required',
            'quantity'=>'required'
        ]);
        $shoe_id = $request->get('id');
        $qty = $request->get('quantity');
        //setelah di validasi, maka kita akan mengambil mencari id user untuk mengambil cart dari user tersebut
        $user_id = Auth::id();
        //mengecek apakah cart dari user tersebut sudah terdapat sepatu yang ingin di add to cart atau belum
        $x = Cart::where('user_id', $user_id)->where('shoe_id', $shoe_id)->first();

        //jika cart dengan sepatu tersebut masih kosong, maka akan insert new cart dengan sepatu itu
        if($x == null){
            $cart = new Cart([
                'user_id' => $user_id,
                'shoe_id' => $shoe_id,
                'quantity' => $qty
            ]);
            $cart->save();
        }
        //jika cart dengan sepatu tersebut sudah ada, maka quantitynya saja akan ditambahkan
        else{
            $x->quantity += $qty;
            $x->save();
        }
        //notes untuk COllection(get) pake bla->count(), utk Eloquent(first) pake == null

        //setelah add tu cart maka user akan di redirect ke /shoe
        return redirect('/shoe');
    }


    public function viewCart(){
        //function ini menampilkan cart dari user yang login, maka dari itu kita harus menemukan id dari user tersebut
        $user_id = Auth::id();
        //mencari cart dari user berdasarkan id nya
        $carts = Cart::all()->where('user_id', $user_id);

        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        //mengecek apakan cart dari user kosong atau tidak, if ini digunakan untuk menampilkan tombol checkout
        if($carts->count() > 0){
            foreach ($carts as $cart){
                $cart->shoe = $cart->shoe()->first();
            }
            return view('cart', ['carts' => $carts, 'auth'=>$auth,'role'=>$role]);
        }
        //jika cart masih kosong maka tombol check out tidak muncul
        return view('cart', ['carts' => 'null', 'auth'=>$auth,'role'=>$role]);
    }

    public function checkoutCart(){
        //function ini digunakan ketika user klik tombol checkout
        //awalnya kita akan mencari cart dari user
        $user_id = Auth::id();
        $carts = Cart::all()->where('user_id', $user_id);
        //variabel ini untuk menampung total price
        $total_price = 0;
        //akan dilooping untuk menghitung total price
        foreach($carts as $cart){
            $cart->shoe = $cart->shoe()->first();
            $total_price += $cart->shoe->price;
        }
        //setelah dihitung akan di insert ke header dan detail transaction
        $header_transaction = new HeaderTransaction();
        $header_transaction->user_id = $user_id;
        $header_transaction->total_price = $total_price;
        $header_transaction->transaction_date = Carbon::now();; //menampilkan datetime
        $header_transaction->save();
        $header_id = $header_transaction->id;

        //untuk deteail terdapat foreach untuk insert semua sepatu yang ada di cart
        foreach($carts as $cart){
            $detail_transaction = new DetailTransaction();
            $detail_transaction->header_transaction_id = $header_id;
            $detail_transaction->shoe_id = $cart->shoe->id;
            $detail_transaction->quantity = $cart->quantity;
            $detail_transaction->save();
            $cart->delete();
        }
        //setelah di insert akan di redirect ke shoe
        return redirect('/shoe');

    }

    public function geteditCart($id){
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        $user_id = Auth::id();
        //mencari shoe id untuk menampilkan detail dari shoe
        $shoe = Shoe::find($id);
        //mencari cart untuk menampilkan quantity
        $cart = Cart::where('user_id',$user_id)->where('shoe_id',$id)->first();

        //function ini akan dijalankan di blade editCart
        return view('editCart', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role,'cart'=>$cart]);
    }

    public function postupdateeditcart(Request $request){
        //di dalam edit cart ada 2 tombol yaitu update dan delete
        //jika update maka harus dapat id dari cart
        //awalnya validasi dari input user
        $request->validate([
            'id'=>'required',
            'quantity'=>'required'
        ]);
        //mencari cart yang ingin diupdate
        $user_id = Auth::id();
        $cart = Cart::where('user_id', $user_id)->where('shoe_id', $request->get('id'))->first();
        //jika route yang dicari null maka tidak terjadi apa2 dan di redirect ke halaman cart
        if($cart == null) return redirect()->route('cart');
        //jika cart ada, maka akan diupdate quantity nya kemudian di save
        else{
            $cart->quantity = $request->get('quantity');
            $cart->save();
        }
        return redirect('/viewCart');

    }

    public function postdeleteeditcart(Request $request){
        //id dari cart akan diterima
        $request->validate([
            'id'=>'required'
        ]);
        //mencari cart yang mau dihapus
        $id = $request->get('id');
        $cart = Cart::find($id);
        //hapus cart
        $cart->delete();
        return redirect('/viewCart');
    }

}
