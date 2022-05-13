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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class VilleController extends Controller
{
    /**
     * Afficher toutes les villes.
     * @queryParam nom Le nom de la ville. No-example
     * @queryParam page int Le numéro de la page. No-example
     * @queryParam per_page int Le nombre de résultats par page. No-example
     * @queryParam sort_by string L'ordre de tri. No-example
     *
     * @return PageableResource
     */
    public function index(Request $request)
    {
        $villes = Ville::query();

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('villes', $key)) {
                if (Str::contains($key, '_id')) {
                    $villes->where($key, $value);
                }
                $villes->where($key, 'LIKE', "%{$value}%");
            }
        }

        $villes->orderBy('nom', $request->sort_by ?? 'asc');
        $villes = $villes->paginate($request->per_page ?? Ville::count());

        return new PageableResource(VilleResource::collection($villes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVilleRequest $request
     * @return Response
     */
    public function store(StoreVilleRequest $request)
    {
        //
    }

    /**
     * Afficher une ville.
     *
     * @param Ville $ville
     * @return VilleResource
     */
    public function show(Ville $ville)
    {
        return new VilleResource($ville);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateVilleRequest $request
     * @param Ville $ville
     * @return Response
     */
    public function update(UpdateVilleRequest $request, Ville $ville)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ville $ville
     * @return Response
     */
    public function destroy(Ville $ville)
    {
        //
    }
}
