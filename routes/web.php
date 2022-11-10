<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();

Route::get('/home',[App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(ObjetoController::class)->group(function(){
    Route::get('objetos', 'index')->name('objetos.index');
    Route::get('objetos/create','create')->name('objetos.create');

    Route::post('objetos','store')->name('objetos.store');

    Route::get('objetos/{objeto}', 'show')->name('objetos.show');
    Route::get('objetos/{objeto}/edit', 'edit')->name('objetos.edit');

//metodo put para actualizar no post.
    Route::put('objetos/{objeto}', 'update')->name('objetos.update');

    Route::delete('objetos/{id}', 'destroy')->name('objetos.destroy');
});
