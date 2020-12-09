<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function (){
//    return view('welcome');
//});
Route::get('/', 'AppController@index');
Route::get('/shoe', 'AppController@index');
Route::get('/shoe/{id}', 'AppController@detail');

Route::get('/getUpdateShoe/{id}', 'AppController@getUpdateShoe');
Route::post('/postUpdateShoe', 'AppController@postUpdateShoe')->name('shoe.update');

Route::get('/getAddToCart/{id}', 'AppController@getAddToCart');
Route::post('/postAddToCart', 'AppController@postAddToCart')->name('cart.add');
Route::get('/viewCart', 'AppController@viewCart');
Route::post('/checkout', 'AppController@checkoutCart');
Route::get('/editCart/{id}', 'AppController@geteditCart');
Route::post('/updateCart', 'AppController@postupdateeditCart')->name('cart.update');
Route::post('/deleteCart', 'AppController@postdeleteeditCart')->name('cart.delete');

Route::get('/viewTrans', 'AppController@viewTrans');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
