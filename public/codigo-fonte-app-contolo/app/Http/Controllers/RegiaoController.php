<?php

namespace App\Http\Controllers;

use App\Models\Regiao;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRegiaoRequest;
use App\Http\Requests\UpdateRegiaoRequest;

class RegiaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
            $tot = Regiao::count();
            $provincias = Provincia::all();
         $regioes = Regiao::all();

        return view('regiao.index', compact('regioes', 'tot', 'provincias'));
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
     * @param  \App\Http\Requests\StoreRegiaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreRegiaoRequest $request)
    public function store(Request $request)
    {
        //
        // dd($request);
        try {
            #--- Validar dados antes de guardar-los ---#
            $this->validate($request, [
                'provincia_id' => 'required',
                'cod_regiao' => 'required',
                'regiao' => 'required',
            ]);

                $regiao = new Regiao();
                $regiao->cod_regiao = $request->cod_regiao;
                $regiao->regiao = $request->regiao;
                $regiao->provincia_id = $request->provincia_id;
                $regiao->save();

            return redirect(route('regioes.index'))->with('success', '[OK] Dados registado com sucesso');
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){
                #-- Se erro é de debug d'aplicação, recuperamos esse erro e mostramo-lo com seu codigo
                return redirect(route('regioes.index'))->with('error', '[DEBUG] Operação abortada!');
            }
            return redirect(route('regioes.index'))->with('error', '[ERROR] Houve erro, dados não registados!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function show(Regiao $regiao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        //
        $data = Regiao::findOrFail($id);
        // dd($data);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegiaoRequest  $request
     * @param  \App\Models\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegiaoRequest $request, Regiao $regiao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regiao  $regiao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regiao $id)
    {
        //
        try {
            //code...
            if($id->delete()){

                return redirect(route('regioes.index'))->with('success', '[OK] Registo eliminado.');
            }

            ##-- Retornar mensagem de sucesso
            // return response()->json(['msg' => 'Dados de '.$id->name.' foram eliminados com sucesso!'], 200);

        } catch (\Exception $e) {
            //throw $th;
            if(config('app.debug')){
                return redirect(route('regioes.index'))->with('error', '[ERRO] Houve erro,  operação abortada.');
            }
            // return response()->json(ApiError::errorMessage('Houve um erro ao realizar operaçcao.', 1012));
            return redirect(route('regioes.index'))->with('error', '[ERRO] Houve erro,  registo não eliminado.');
        }

    }
}
