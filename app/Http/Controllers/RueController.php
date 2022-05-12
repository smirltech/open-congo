<?php

namespace App\Http\Controllers;

use App\Models\Rue;
use App\Http\Requests\StoreRueRequest;
use App\Http\Requests\UpdateRueRequest;

class RueController extends Controller
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
     * @param  \App\Http\Requests\StoreRueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rue  $rue
     * @return \Illuminate\Http\Response
     */
    public function show(Rue $rue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRueRequest  $request
     * @param  \App\Models\Rue  $rue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRueRequest $request, Rue $rue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rue  $rue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rue $rue)
    {
        //
    }
}
