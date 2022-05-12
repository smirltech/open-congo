<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Http\Requests\StoreCommuneRequest;
use App\Http\Requests\UpdateCommuneRequest;

class CommuneController extends Controller
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
     * @param  \App\Http\Requests\StoreCommuneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommuneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommuneRequest  $request
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommuneRequest $request, Commune $commune)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commune $commune)
    {
        //
    }
}
