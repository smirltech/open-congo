<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageableResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\VilleResource;
use App\Models\Province;
use App\Models\Ville;
use App\Http\Requests\StoreVilleRequest;
use App\Http\Requests\UpdateVilleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class VilleController extends Controller
{
    /**
     * Display a listing of villes.

     * @queryParam nom The keyword to search for. No-example
     * @queryParam page int The page number. No-example
     * @queryParam per_page int The number of villes on a page. No-example
     * @queryParam sort_by string The order to sort by, asc or desc. No-example
     *
     * @return PageableResource
     */
    public function index(Request $request)
    {
        $villes = Ville::query();

        foreach ($request->all() as $column => $value) {
            $op = "LIKE";
            if (Schema::hasColumn('villes', $column)) {
                $villes->where($column, $op, "%{$value}%");
            }
        }

        $villes->orderBy('nom', $request->sort_by ?? 'asc');
        $villes = $villes->paginate($request->per_page ?? Ville::count());

        return new PageableResource(VilleResource::collection($villes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVilleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVilleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ville  $ville
     * @return VilleResource
     */
    public function show(Ville $ville)
    {
        return new VilleResource($ville);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVilleRequest  $request
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVilleRequest $request, Ville $ville)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ville $ville)
    {
        //
    }
}
