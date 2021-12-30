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
    return view('welcome');
});

/*Route::post('/api/user', function () {
    return ['name'=> ''];
});*/

Route::post('/api/user', 'App\Http\Controllers\test\UserController@salvar'); // ok
Route::get('/api/users', 'App\Http\Controllers\test\UserController@index'); // OK
Route::get('/api/user/{id}', 'App\Http\Controllers\test\UserController@ver'); // BUG, BUG, BUG, OK
Route::put('/api/user/{id}', 'App\Http\Controllers\test\UserController@atualizar'); // BUG, BUG, BUG, BUG, BUG, BUG, OK
Route::delete('/api/user/{id}', 'App\Http\Controllers\test\UserController@excluir'); // BUG, OK;
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
