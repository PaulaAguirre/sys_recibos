<?php

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
    if(Auth::check ())
    {
        return redirect ('/recibos');
    }
    else
    {
        return redirect ('login');
    }
});

Auth::routes();
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::group (['middleware'=>'auth'], function (){
    Route::resource ('recibos', 'ReciboController');
    Route::resource ('clientes', 'ClienteController');
    Route::resource ('users', 'UserController');
});

//Route::get('/home', 'HomeController@index')->name('home');

