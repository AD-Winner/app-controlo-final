<?php

namespace App\Http\Controllers;

use App\Models\Regiao;
use App\Models\Sector;
use App\Models\Circulo;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectorRequest;
use App\Http\Requests\UpdateSectorRequest;

class SectorController extends Controller
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
        $sectores = Sector::all();

        $tot = Sector::count();

        return view('sector.index', compact('circulos', 'tot', 'sectores', 'regioes','provincias'));
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
     * @param  \App\Http\Requests\StoreSectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectorRequest $request)
    // public function store(Request $request)
    {
        //

        // try {
            //code...
            $request->validate([
                'provincia_id' => 'required|integer|exists:provincias,id',
                'regiao_id' => 'required|integer|exists:regiaos,id',
                'circulo_id' => 'required|integer|exists:circulos,id',
                'cod_sector' => 'required|integer',
                'sector' => 'required|unique:sectors|string|max:191|min:2',
            ]);

            $sector = new Sector();
            $sector->provincia_id = $request->provincia_id;
            $sector->regiao_id = $request->regiao_id;
            $sector->circulo_id = $request->circulo_id;
            $sector->cod_sector = $request->cod_sector;
            $sector->sector = $request->sector;
            $sector->save();

            return redirect(route('sector.index'))->with('success', '[OK] Dados registados com success.');

        // } catch (\Throwable $th) {
        //     //throw $th;
        //     if(config('app.debug')){

        //         return redirect(route('sector.index'))->with('error', '[ERRO]  Operação abortada!');
        //     }
        //     return redirect(route('sector.index'))->with('error', '[ERRO] Dados não registados!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectorRequest  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        try {
            //code...
            if(Sector::find($id)->delete()){
                return redirect(route('sector.index'))->with('success', '[OK] Registo eliminado com sucesso.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){

                return redirect(route('sector.index'))->with('error', '[ERRO] Operação abortada, registo não eliminado!');
            }
            return redirect(route('sector.index'))->with('error', '[ERRO] Registo não eliminado!');
        }
    }
}
