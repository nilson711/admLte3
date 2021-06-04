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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/home', 'HomeController@index')->name('home');

// Rotas das Tarefas
Route::post('/new_task_submit', [App\Http\Controllers\TarefaController::class, 'new_task_submit'])->name('new_task_submit');

// Rotas dos Clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'clientes'])->name('clientes');
