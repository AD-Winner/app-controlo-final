<?php

namespace App\Http\Controllers;

use App\Models\Recenseado;
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
