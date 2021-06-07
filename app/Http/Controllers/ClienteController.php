<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use \ DB;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientes()
    {
        $clientes = DB::SELECT("SELECT * FROM clientes");
        return view('clientes', ['clientes'=> $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new_cliente_submit(Request $request)
    {
        //ADICIONA NOVO CLIENTE

        //BUSCA DADOS DOS INPUTS
        $newCliente = $request->input('cliente');
        $newEndereco = $request->input('endereco');
        $newTelefone = $request->input('telefone');
        $newCelular = $request->input('celular');
        $newEmail = $request->input('e-mail');

        //SALVA OS DADOS DOS INPUTS NO BANDO DE DADOS
        $TBCliente = new Cliente();
        $TBCliente->cliente = $newCliente;
        $TBCliente->endereco = $newEndereco;
        $TBCliente->telefone = $newTelefone;
        $TBCliente->celular = $newCelular;
        $TBCliente->email = $newEmail;
        $TBCliente->save();

        return redirect()->to('/clientes');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
