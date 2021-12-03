<?php

use App\Mail\EmailFimSolicit;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
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
Route::post('/cancelar_solicit/{id}', [App\Http\Controllers\SolicitacaoController::class, 'cancelar_solicit'])->name('cancelar_solicit');
Route::post('/add_equip_pct', [App\Http\Controllers\SolicitacaoController::class, 'add_equip_pct'])->name('add_equip_pct');
Route::get('/edit_solicit/{id}', [App\Http\Controllers\SolicitacaoController::class, 'edit_solicit'])->name('edit_solicit');

Route::post('/cancelAllEquipsSolicit/{solicit_equip}', [App\Http\Controllers\SolicitacaoController::class, 'cancelAllEquipsSolicit'])->name('cancelAllEquipsSolicit');
Route::post('/cancelOneEquipSolicit/{idEquip}/{solicit_equip?}', [App\Http\Controllers\SolicitacaoController::class, 'cancelOneEquipSolicit'])->name('cancelOneEquipSolicit');

Route::get('/fim_solicitacao', [App\Http\Controllers\SolicitacaoController::class, 'iniciar_solicit'])->name('fim_solicitacao');

// Route::get('/fim_solicitacao', function(){

//     $nome = 'Antonio 45';

//     Mail::to('nilson711@hotmail.com')->send(new EmailFimSolicit($nome));
//     echo 'email enviado';
// });

//Rota de Fallback
Route::fallback(function(){
    echo 'O caminho acessado não existe. <a href="/home">clique a aqui</a> para ir para a página inicial.';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
