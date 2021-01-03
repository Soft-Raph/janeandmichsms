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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client/{id}', [App\Http\Controllers\ClientController::class, 'profile'])->name('client.profile');
Route::get('/client/delete/{id}', [App\Http\Controllers\ClientController::class, 'delete'])->name('client.delete');
Route::post('/add/client', [App\Http\Controllers\ClientController::class, 'store'])->name('add.client');
Route::post('/update/messages', [App\Http\Controllers\ClientController::class, 'store_messages'])->name('update.messages');
Route::post('/send/message', [App\Http\Controllers\ClientController::class, 'message'])->name('send.messages');


Route::get('/auto', [App\Http\Controllers\ClientController::class, 'automate']);
