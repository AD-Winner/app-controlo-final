<?php

namespace App\Http\Controllers;

use App\Models\Recenseamento;
use App\Http\Requests\StoreRecenseamentoRequest;
use App\Http\Requests\UpdateRecenseamentoRequest;

class RecenseamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $recenseamentos = Recenseamento::all();
        $tot = Recenseamento::count();
        return view('recenseamento.index', compact('recenseamentos','tot'));

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
     * @param  \App\Http\Requests\StoreRecenseamentoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecenseamentoRequest $request)
    {
        //

        $request->validate([

            'data' => 'required|date|after:today',
            'tipo' => 'required|string|max:191|min:2',
        ]);

        $recenseamento =  new Recenseamento();
        $recenseamento->data = $request->data;
        $recenseamento->tipo = $request->tipo;
        $recenseamento->save();
        return redirect(route('recenseamento.index'))->with('success', '[OK] Recenseamento registado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recenseamento  $recenseamento
     * @return \Illuminate\Http\Response
     */
    public function show(Recenseamento $recenseamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recenseamento  $recenseamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Recenseamento $recenseamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecenseamentoRequest  $request
     * @param  \App\Models\Recenseamento  $recenseamento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecenseamentoRequest $request, Recenseamento $recenseamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recenseamento  $recenseamento
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        try {
            if(Recenseamento::find($id)->delete()){
                return redirect(route('recenseamento.index'))->with('success', '[OK] Registo eliminado.');
            }
        } catch (\Throwable $th) {
            //throw $th;

            if(config('app.debug')){
                return redirect(route('recenseamento.index'))->with('error', '[ERRO] Operação abortada.');
            }
            return redirect(route('recenseamento.index'))->with('error', '[ERRO] Registo não eliminado.');

        }
    }
}
