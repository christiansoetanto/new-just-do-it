<?php /** @noinspection ALL */


namespace App\Http\Controllers;

use App\Cart;
use App\DetailTransaction;
use App\HeaderTransaction;
use App\Shoe;
use App\Transaction;
use App\User;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AppController extends Controller
{
    public function index(){
        $shoes = Shoe::all();
        return view('allshoe', ['shoes' => $shoes]);

    }
    public function detail($id){
        $shoe = Shoe::find($id);
        return view('detail', ['shoe' => $shoe]);
    }

    public function getAddToCart($id){
        $shoe = Shoe::find($id);
        return view('addToCart', ['shoe' => $shoe]);
    }

    public function postAddToCart(Request $request){

        $request->validate([
            'id'=>'required',
            'quantity'=>'required'
        ]);

        $shoe_id = $request->get('id');
        $qty = $request->get('quantity');

        $user_id = 1;
        $x = Cart::where('user_id', $user_id)->where('shoe_id', $shoe_id)->first();
        if(x == null){

        }

        //find dulu shoe id nya,
        //kalau sudah ada, tambah quantity,
        //kalau belum ada, insert baru.

        //notes untuk COllection(get) pake bla->count(), utk Eloquent(first) pake == null
        $cart = new Cart([
            'user_id' => 1,
            'shoe_id' => $shoe_id,
            'quantity' => $qty
        ]);
        $cart->save();

        return redirect('/shoe');

    }
    public function getUpdateShoe($id){
        $shoe = Shoe::find($id);
        return view('updateShoe', ['shoe' => $shoe]);
    }

    public function postUpdateShoe(Request $request){
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);

        $shoe = Shoe::find($request->get('id'));
        $shoe->name = $request->get('name');
        $shoe->price = $request->get('price');
        $shoe->description = $request->get('description');
        $shoe->name = $request->get('name');
        $shoe->save();
        return redirect('/shoe');

    }

    public function viewCart(){

        $carts = Cart::all()->where('user_id', 1);
        foreach ($carts as $cart){
            $cart->shoe = $cart->shoe()->first();
        }
        return view('cart', ['carts' => $carts]);
    }

    public function checkoutCart(){
        $user_id = 1;
        $carts = Cart::all()->where('user_id', 1);
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

    public function viewTrans(){
        $user_id = 1;
        $header_transactions = HeaderTransaction::where('user_id'   , 100)->first();
        dd($header_transactions);
        if($header_transactions->count()){
            echo "123";
        }else{
            echo "456";
        }
        dd($header_transactions);

        foreach ($header_transactions as $head){
            $head->detail_transaction = $head->detail_transaction()->get();
            foreach($head->detail_transaction as $detail){
                $detail->shoe = $detail->shoe()->first();
            }
        }
        return view('transaction', ['transactions' => $header_transactions]);
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
