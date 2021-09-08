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

Route::get('test', 'HomeController@test');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('api/savescore', 'ScoreController@saveScore');

Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('manage', 'QuoteController@manageQuotes')->name('manage');
    Route::get('editquote/{id}', 'QuoteController@editQuote');
    Route::get('addquote', 'QuoteController@addQuotePage');
});


Route::group(['middleware' => ['auth']], function(){
    Route::get('leaderboards', 'QuoteController@getLeaderboard');
    Route::get('viewscore/{id}', 'ScoreController@viewScore');
});