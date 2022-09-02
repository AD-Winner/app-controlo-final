<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Http\Requests\StoreProvinciaRequest;
use App\Http\Requests\UpdateProvinciaRequest;
use GuzzleHttp\Handler\Proxy;
use GuzzleHttp\Psr7\Request;

use function Psy\debug;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $tot = Provincia::count();
        $provincias = Provincia::all();
        return view('provincias.index', compact('tot', 'provincias'));
    }

    public function allData(){
        $data = Provincia::orderBy('id', 'DESC')->get();
        return response()->json($data);
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
     * @param  \App\Http\Requests\StoreProvinciaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProvinciaRequest $request)
    {
        //
        // dd($request);
        try {
            //code...
            $request->validate([
                'provincia' => 'required',
            ]);
            $prov = new Provincia();
            $prov->provincia = $request->provincia;
            $prov->save();
            return redirect(route('provincia.index'))->with('success', '[OK] Dados registado com successo');
        } catch (\Throwable $th) {
            //throw $th;

            if(config('app.debug')){
                return redirect(route('provincia.index'))->with('error', '[ERRO] Houve erro,  operação abortada.');
            }
            // return response()->json(ApiError::errorMessage('Houve um erro ao realizar operaçcao.', 1012));
            return redirect(route('provincia.index'))->with('error', '[ERRO] Houve erro,  registo não eliminado.');
        }
        // $data = Provincia::insert([
        //     'provincia' => $request->provincia,
        // ]);
        // return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function show(Provincia $provincia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Provincia::findOrFail($id);
        // dd($data);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProvinciaRequest  $request
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinciaRequest $request, Provincia $provincia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        try {
            //code...
            if(Provincia::find($id)->delete()){
                return redirect(route('provincia.index'))->with('success', '[OK] Registo eliminado.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            if(config('app.debug')){
                return redirect(route('provincia.index'))->with('error', '[ERRO] Operação abortada.');
            }
            return redirect(route('provincia.index'))->with('error', '[ERRO] Registo não eliminado.');
        }
    }
}
