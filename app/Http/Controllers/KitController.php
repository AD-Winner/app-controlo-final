<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Provincia;
use App\Http\Requests\StoreKitRequest;
use App\Http\Requests\UpdateKitRequest;
use App\Models\Circulo;
use App\Models\Recenseado;
use App\Models\Recenseamento;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $recenseamento = Recenseamento::all()->last();
        $kits = Kit::all();
        $tot = Kit::count();
        $provincias = Provincia::all();
        $sectores = Sector::all();
        $regioes = Regiao::all();
        $circulos = Circulo::all();


        return view('kit.index', compact('kits', 'tot', 'provincias', 'sectores','circulos', 'regioes', 'recenseamento'));
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
     * @param  \App\Http\Requests\StoreKitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitRequest $request)
    {
        //

        // dd($request);

        $request->validate([
            'numero' => 'required|integer',
            'descricao' => 'required|unique:kits|string|max:255|min:2',
            'recenseamento_id' => 'required|integer|exists:recenseamentos,id',
            'provincia_id' => 'required|integer|exists:provincias,id',
            'regiao_id' => 'required|integer|exists:regiaos,id',
            'circulo_id' => 'required|integer|exists:circulos,id',
        ]);

        $kit = new Kit();
        $kit->numero = $request->numero;
        $kit->descricao = $request->descricao;
        $kit->circulo_id = $request->circulo_id;
        $kit->regiao_id = $request->regiao_id;
        $kit->sector_id = $request->sector_id;
        $kit->provincia_id = $request->provincia_id;
        $kit->recenseamento_id = $request->recenseamento_id;
        $kit->save();
        return redirect(route('kit.index'))->with('success', '[OK] Kit de recenseamento registado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function show(Kit $kit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function edit(Kit $kit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitRequest  $request
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitRequest $request, Kit $kit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kit  $kit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    try {
        //code...
        if(Kit::find($id)->delete()){
            return redirect(route('kit.index'))->with('success', '[OK] Registo eliminado.');
        }
    } catch (\Throwable $th) {
        //throw $th;

        if(config('app.debug')){
            return redirect(route('kit.index'))->with('error', '[ERRO] Operação abortada');
        }

        return redirect(route('kit.index'))->with('error','[ERRO] Registo não eliminado!');
    }
    }
}
