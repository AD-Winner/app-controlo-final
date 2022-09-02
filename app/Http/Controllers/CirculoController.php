<?php

namespace App\Http\Controllers;

use App\Models\Circulo;
use App\Http\Requests\StoreCirculoRequest;
use App\Http\Requests\UpdateCirculoRequest;
use App\Models\Provincia;
use App\Models\Regiao;

class CirculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $circulos = Circulo::all();
        $provincias = Provincia::all();
        $regioes = Regiao::all();

        $tot = Circulo::count();

        return view('circulo.index', compact('circulos', 'tot', 'regioes','provincias'));
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
     * @param  \App\Http\Requests\StoreCirculoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCirculoRequest $request)
    {
        //

        try {
            //code...
            $request->validate([
                // 'provincia_id' => 'required',
                'provincia_id' => 'required|integer|exists:provincias,id',
                // 'regiao_id' => 'required',
                'regiao_id' => 'required|integer|exists:regiaos,id',
                'cod_circulo' => 'required',
                // 'circulo' => 'required',
                'circulo' => 'required|unique:circulos|string|max:50|min:2',

            ]);
            $circulo = new Circulo();
            $circulo->cod_circulo = $request->cod_circulo;
            $circulo->circulo = $request->circulo;
            $circulo->provincia_id = $request->provincia_id;
            $circulo->regiao_id = $request->regiao_id;
            $circulo->save();
            return redirect(route('circulo.index'))->with('success', '[OK] Circulo registado com sucesso.');
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){
                return redirect(route('circulo.index'))->with('error', '[ERRO] Houve erro,  operação abortada.');
            }
            return redirect(route('circulo.index'))->with('error', '[ERRO] Falha ao registar dados.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Circulo  $circulo
     * @return \Illuminate\Http\Response
     */
    public function show(Circulo $circulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Circulo  $circulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Circulo $circulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCirculoRequest  $request
     * @param  \App\Models\Circulo  $circulo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCirculoRequest $request, Circulo $circulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Circulo  $circulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    try {
        //code...
        if(Circulo::find($id)->delete()){
            return redirect(route('circulo.index'))->with('success','[OK]: Registo eliminado com successo.');
        }
    } catch (\Throwable $th) {
        //throw $th;
        if(config('app.debug')){

            return redirect(route('circulo.index'))->with('error','[ERRO]: Operação abortada!');
        }
        return redirect(route('circulo.index'))->with('error','[ERRO]: Registo não eliminado!');
    }
    }
}
