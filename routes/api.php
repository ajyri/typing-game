<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/randomquote','QuoteController@getRandomQuote');

Route::get('/quote','QuoteController@getAllQuotes');

Route::get('/quote/{id}','QuoteController@getQuote');

//Route::post('/saveScore','ScoreController@saveScore');

Route::post('/quote','QuoteController@addQuote');
Route::patch('/quote/{id}',['uses' => 'QuoteController@update']);
Route::delete('/quote/{id}','QuoteController@destroy');
