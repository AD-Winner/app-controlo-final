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
    public function destroy(Recenseamento $recenseamento)
    {
        //
    }
}
