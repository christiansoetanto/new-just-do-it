<?php

namespace App\Http\Controllers;

use App\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoeController extends Controller
{
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
            'description'=>'required',
            'photo' =>'mines:jpeg,jpg,png'
        ]);

        $shoe = Shoe::find($request->get('id'));
        $shoe->name = $request->get('name');
        $shoe->price = $request->get('price');
        $shoe->description = $request->get('description');
//        dd($request->file('file'));
        if($request -> file()){
            $filename = $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('uploads',$filename,'public');
            $shoe->photo = $filename;

        }


        $shoe->save();
        return redirect('/shoe')->with('success','update success');

    }

    public function getAddShoe(){
        $auth = Auth::check();
        $role = 'guest';
        if($auth){
            $role = Auth::user()->role;
        }
        return view('addShoe',['auth'=>$auth,'role'=>$role]);
    }

    public function postAddShoe(Request $request){
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required',
            'photo' =>'required|mines:jpeg,jpg,png'
        ]);

        if($request->file()){
            $photo = $request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('uploads',$photo,'public');
            $shoe = new Shoe([
                'name' => $request->get('name'),
                'photo' => $photo,
                'description'=> $request->get('description'),
                'price' => $request->get('price')
            ]);
//            dd($shoe);

            $shoe -> save();
        }

        return redirect('/shoe')->with('success','update success')->with('file',$photo);

    }
}
