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
Route::post('/checkTarefa', [App\Http\Controllers\TarefaController::class, 'checkTarefa'])->name('checkTarefa');

// Rotas dos Clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'clientes'])->name('clientes');
Route::get('/listapcthc/{id}', [App\Http\Controllers\ClienteController::class, 'listapcthc'])->name('listapcthc');
Route::post('/new_cliente_submit', [App\Http\Controllers\ClienteController::class, 'new_cliente_submit'])->name('new_cliente_submit');

// Rotas dos Equipamentos
Route::get('/equipamentos', [App\Http\Controllers\EquipamentoController::class, 'listaEquips'])->name('listaEquips');
Route::post('/newEquipSubmit', [App\Http\Controllers\EquipamentoController::class, 'newEquipSubmit'])->name('newEquipSubmit');

//Rotas dos Pacientes
Route::get('/pacientes', [App\Http\Controllers\PctController::class, 'listaPcs'])->name('listaPcs');
Route::post('/new_Pct_submit', [App\Http\Controllers\PctController::class, 'new_Pct_submit'])->name('new_Pct_submit');
Route::get('/editPct/{id}', [App\Http\Controllers\PctController::class, 'editPct'])->name('editPct');
Route::post('/edit_Pct_submit/{id}', [App\Http\Controllers\PctController::class, 'edit_Pct_submit'])->name('edit_Pct_submit');

//Rotas das Solicitações
Route::post('/new_solicita', [App\Http\Controllers\SolicitacaoController::class, 'new_solicita'])->name('new_solicita');
Route::get('/solicitacoes', [App\Http\Controllers\SolicitacaoController::class, 'solicitacoes'])->name('solicitacoes');
Route::post('/iniciar_solicit/{id}', [App\Http\Controllers\SolicitacaoController::class, 'iniciar_solicit'])->name('iniciar_solicit');

