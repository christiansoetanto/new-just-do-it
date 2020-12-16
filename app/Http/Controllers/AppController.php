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
        // menerima inputan search dari user
        $search = $request->input('search');
        //paginate 6 all shoe
        $shoes = Shoe::paginate(6);
        // mencari shoe berdasarkan inputan dari user lalu di paginate 6
        $shoes = Shoe::where('name','like',"%$search%")->paginate(6);
        //menngecek apakah ada user login atau hanya mengunjungi website untuk mendapatkan role dari user
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        //retrun ke blade allshoe dengan passing status login, shoe dan role dari user
        return view('allshoe', ['shoes' => $shoes,'auth'=>$auth,'role'=>$role]);

    }
    public function detail($id){
        //untuk mendapatkan detail dari shoe, maka id dari shoe akan diterima sebagai parameter untuk mencari detail shoe tersebut
        $shoe = Shoe::find($id);
        //halaman ini juga memerlukan status login dari user untuk mendapatkan role user
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        //function ini akan digunakan di blade detail dengan mengirim 1 shoe yang telah dicari berdasarkan id nya, role dan status login
        return view('detail', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role]);
    }


}
