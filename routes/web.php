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
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware'=>['auth']],function(){

    Route::get('/home', 'HomeController@index')->name('home');

    // route user
    Route::prefix('user')->group(function(){
        Route::get('','UserController@index')->name('user');
        Route::get('/json','UserController@datajson_user')->name('json_user');
        Route::post('/create_user', 'UserController@create_user')->name('create_user');
        Route::post('/update_user/{id}', 'UserController@update_user')->name('update_user');
        Route::get('/delete_user/{id}', 'UserController@delete_user')->name('delete_user');
        Route::post('/change_user', 'UserController@change_password')->name('change_password');

    });
});

Route::fallback(function() {
    return view('errorpage/error404');
});