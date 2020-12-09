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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AppController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $shoes = Shoe::paginate(6);
        $shoes = Shoe::where('name','like',"%$search%")->paginate(6);
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        return view('allshoe', ['shoes' => $shoes,'auth'=>$auth,'role'=>$role]);

    }
    public function detail($id){
        $shoe = Shoe::find($id);
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        return view('detail', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role]);
    }

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

    public function getUpdateShoe($id){
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        $shoe = Shoe::find($id);
        return view('updateShoe', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role]);
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
//        $shoe->name = $request->get('name');
        $shoe->save();
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


}
