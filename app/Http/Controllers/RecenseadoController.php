<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use App\Models\Provincia;
use App\Models\Recenseado;
use App\Models\Recenseamento;
use App\Http\Requests\StoreRecenseadoRequest;
use App\Http\Requests\UpdateRecenseadoRequest;

class RecenseadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //code...
            $recenseamento = Recenseamento::all()->last();
            $kits = Kit::where('recenseamento_id', $recenseamento->id)->get();
            $m = Recenseado::where('recenseamento_id', $recenseamento->id)
                ->sum('homen');
            $f = Recenseado::where('recenseamento_id', $recenseamento->id)
                ->sum('mulher');
            $tot = $m + $f;
            $provincias = Provincia::all();
            $sectores = Sector::all();
            $regioes = Regiao::all();
            $circulos = Circulo::all();
            $recenseados = Recenseado::where('recenseamento_id', $recenseamento->id)->get();
            return view('recenseado.index', compact('kits','recenseados', 'tot', 'provincias', 'sectores','circulos', 'regioes', 'recenseamento'));

        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){
                return redirect(route('recenseado.index'))->with('error', '[ERRO]  Operação abortada!');
            }
                    return redirect(route('recenseado.index'))->with('error', '[ERRO] Impossivel efetuar operação!');
        }

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
     * @param  \App\Http\Requests\StoreRecenseadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecenseadoRequest $request)
    {
        //
        // dd($request);
        $request->validate([

            'data' => 'required|date',
            'homen' => 'required|integer|max:1000|min:1',
            'mulher' => 'required|integer|max:1000|min:1',

            'recenseamento_id' => 'required|integer|exists:recenseamentos,id',
            'provincia_id' => 'required|integer|exists:provincias,id',
            'regiao_id' => 'required|integer|exists:regiaos,id',
            'circulo_id' => 'required|integer|exists:circulos,id',
            'sector_id' => 'required|integer|exists:sectors,id',
            'kit_id' => 'required|integer|exists:kits,id',
        ]);


        $recenseado = new Recenseado();
        $recenseado->data = $request->data;
        $recenseado->homen = $request->homen;
        $recenseado->mulher = $request->mulher;
        $recenseado->recenseamento_id = $request->recenseamento_id;
        $recenseado->kit_id = $request->kit_id;
        $recenseado->provincia_id = $request->provincia_id;
        $recenseado->regiao_id = $request->regiao_id;
        $recenseado->circulo_id = $request->circulo_id;
        $recenseado->sector_id = $request->sector_id;
        $recenseado->save();
        return redirect(route('recenseado.index'))->with('success', '[OK] Dados registados com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recenseado  $recenseado
     * @return \Illuminate\Http\Response
     */
    public function show(Recenseado $recenseado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recenseado  $recenseado
     * @return \Illuminate\Http\Response
     */
    public function edit(Recenseado $recenseado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecenseadoRequest  $request
     * @param  \App\Models\Recenseado  $recenseado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecenseadoRequest $request, Recenseado $recenseado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recenseado  $recenseado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recenseado $recenseado)
    {
        //
    }
}
