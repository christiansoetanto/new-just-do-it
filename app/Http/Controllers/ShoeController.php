<?php


namespace App\Http\Controllers;

use App\Cart;
use App\Shoe;
use App\Transaction;
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
        return view('getCart')->with('success','berhasil ditambahkan');
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
        return view('getCart')->with('success','berhasil di edit');
    }

    public function deleteCart($id){
        $validator = Validator::make([
            'id' => $id,
        ],[
            'id' => 'required|integer'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $shoe = Cart::find($id);
        $shoe->delete();

        return redirect('cart')->with('success','berhasil delete');

    }

    public function searchShoe(Request $request){
        $search = $request->input('search');

        $shoes = Shoe::where('name','like',"%$search%");
        return view('index',['shoes'=>$shoes]);
    }

}
