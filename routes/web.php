<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceMapController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\DataController;
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

Auth::routes();

//User
Route::get('/', 'PlaceMapController@index')->name('frontpage');

//Admin
Route::group(['middleware' => ['auth']], function () {
    Route::resource('places', 'PlaceController');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/place/data', 'DataController@places')->name('place.data');
    Route::delete('/place/{place}', 'PlaceController@destroy')->name('place.destroy');
});
