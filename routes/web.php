<?php

use App\Record;
use App\Speaker;
use App\Word;
use Illuminate\Http\Request;
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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// record

Route::group(['middleware' => 'auth'], function () {

    Route::get('/record', 'RecordsController@index');

    Route::post('/record', 'RecordsController@store');

    Route::get('/record/{record}', 'RecordsController@show');

    Route::get('/record/get/{record}', 'RecordsController@get');

    Route::get('/record/report/{record}', 'RecordsController@report');

    // Speaker

    Route::get('/speaker/{speaker}', 'SpeakersController@show');

    Route::post('/speaker', 'SpeakersController@store');

    Route::delete('/speaker/{speaker}', 'SpeakersController@destroy');

    // words
    Route::post('/word', 'WordsController@store');

    Route::get('/word/{speaker}', 'WordsController@show');

});

