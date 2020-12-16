<?php

namespace App\Http\Controllers;

use App\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoeController extends Controller
{
    public function getUpdateShoe($id){
        //ketika admin ingin update sebuah shoe
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        //dihalaman update dibutuhkan detail dari sepatu, maka dari itu akan di find shoe berdasarkan id
        $shoe = Shoe::find($id);
        return view('updateShoe', ['shoe' => $shoe,'auth'=>$auth,'role'=>$role]);
    }

    public function postUpdateShoe(Request $request){
        //ketika admin sudah memasukkan data untuk update shoe
        //akan divalidasi setiap inputan user,
        // disini photo tidak require karena jika user tidak ingin updaate foto, maka foto lama akan dipakai
        $request->validate([
            'id'=>'required',
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'photo' =>'mines:jpeg,jpg,png'
        ]);
        //find sepatu yang ingin diupdate dan melakukan update
        $shoe = Shoe::find($request->get('id'));
        $shoe->name = $request->get('name');
        $shoe->price = $request->get('price');
        $shoe->description = $request->get('description');

        //mengecek apakah ada file diupload atau tidak
        if($request -> file()){
            //jika ada, maka filename akan digunakan untuk mencatat nama file baru untuk photo
            $filename = $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('uploads',$filename,'public'); //menyimpan foto di storage/app/public/uploads
            $shoe->photo = $filename;

        }

        //setelah update maka akan disave
        $shoe->save();
        return redirect('/shoe')->with('success','update success');

    }

    public function getAddShoe(){
        //mengecek apakah user login atau tidak untuk menampilkan tombol login register dan logout
        // role digunakan untuk menampiilkan sidebar yang berbeda tergantung role dari user
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        return view('addShoe',['auth'=>$auth,'role'=>$role]);
    }

    public function postAddShoe(Request $request){
        //ketika admin ingin menambahkan sepatu, maka semua atribut dari sepatu harus required
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'photo' =>'required|mines:jpeg,jpg,png'
        ]);
        //setelah divalidasi, maka file juga dipastikan harus ada
        if($request->file()){
            //jika ada, baru bisa di insert new shoe.
            //jika ada, maka filename akan digunakan untuk mencatat nama file baru untuk photo
            $photo = $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('uploads',$photo,'public');//menyimpan foto di storage/app/public/uploads
            $shoe = new Shoe([
                'name' => $request->get('name'),
                'photo' => $photo,
                'description'=> $request->get('description'),
                'price' => $request->get('price')
            ]);

            $shoe -> save();
        }

        return redirect('/shoe')->with('success','update success')->with('file',$photo);
    }
}
