<?php

namespace App\Http\Controllers;

use App\Models\Regiao;
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
    public function store(StoreRegiaoRequest $request)
    {
        //
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
    public function edit(Regiao $regiao)
    {
        //
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
    public function destroy(Regiao $regiao)
    {
        //
    }
}
