<?php /** @noinspection ALL */


namespace App\Http\Controllers;


use App\HeaderTransaction;
use App\User;
use App\Shoe;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


}
