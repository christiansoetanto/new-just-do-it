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

Route::get('/getUpdateShoe/{id}', 'ShoeController@getUpdateShoe');
Route::post('/postUpdateShoe', 'ShoeController@postUpdateShoe')->name('shoe.update');

Route::get('/addShoe', 'ShoeController@getAddShoe');
Route::post('/postAddShoe', 'ShoeController@postAddShoe')->name('shoe.add');


Route::get('/getAddToCart/{id}', 'CartController@getAddToCart');
Route::post('/postAddToCart', 'CartController@postAddToCart')->name('cart.add');

Route::get('/viewCart', 'CartController@viewCart');

Route::post('/checkout', 'CartController@checkoutCart');
Route::get('/editCart/{id}', 'CartController@geteditCart');
Route::post('/updateCart', 'CartController@postupdateeditCart')->name('cart.update');
Route::post('/deleteCart', 'CartController@postdeleteeditCart')->name('cart.delete');

Route::get('/viewTrans', 'TransactionController@viewTrans');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
