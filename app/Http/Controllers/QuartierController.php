<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Http\Requests\StoreQuartierRequest;
use App\Http\Requests\UpdateQuartierRequest;

class QuartierController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuartierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuartierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quartier  $quartier
     * @return \Illuminate\Http\Response
     */
    public function show(Quartier $quartier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuartierRequest  $request
     * @param  \App\Models\Quartier  $quartier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuartierRequest $request, Quartier $quartier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quartier  $quartier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quartier $quartier)
    {
        //
    }
}
