<?php


namespace App\Http\Controllers;

use App\Cart;
use App\Shoe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShoeController extends Controller
{
    public function index(){
        $shoes = Shoe::all();
        dd($shoes);
        return view('index', ['shoes' => $shoes]);

    }
    public function detail($id){
        $shoe = Shoe::all()->where('id', $id);
        dd($shoe);
        return view('detail', ['shoe' => $shoe]);
    }

    public function getCart($id){
        $shoe = Shoe::all()->where('id', $id);
        dd($shoe);
        return view('getCart', ['shoe' => $shoe]);
    }

    public function postCart(Request $request){
        $request->validate([
            'shoe_id'=>'required',
            'qty'=>'required'
        ]);

        $cart = new Cart([
            'user_id' => 1,
            'shoe_id' => $request->get('shoe_id'),
            'quantity' =>$request->get('qty')
        ]);
        $cart->save();
    }
    public function getEdit($id){
        $shoe = Shoe::all()->where('id', $id);
        dd($shoe);
        return view('toEdit', ['shoe' => $shoe]);
    }

    public function postEdit(Request $request){
        $request->validate([
            'id'=>'required',
            'qty'=>'required'
        ]);

        Shoe::where('id', $request->get('id'))->update(['quantity' => $request->get('qty')]);
        dd(Shoe::all());
    }



}
