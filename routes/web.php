<?php

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('api/randomquote','QuoteController@getRandomQuote');

Route::get('api/quote','QuoteController@getAllQuotes');
Route::post('api/quote','QuoteController@addQuote');
Route::get('api/quote/{id}','QuoteController@getQuote');
Route::patch('api/quote/{id}','QuoteController@update');
Route::delete('api/quote/{id}','QuoteController@destroy');
