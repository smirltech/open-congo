<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommuneResource;
use App\Http\Resources\PageableResource;
use App\Http\Resources\VilleResource;
use App\Models\Commune;
use App\Http\Requests\StoreCommuneRequest;
use App\Http\Requests\UpdateCommuneRequest;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

class CommuneController extends Controller
{
    /**
     * Afficher toutes les communes.
     * @queryParam nom Le nom de la commune. No-example
     * @queryParam page int Le numéro de page. No-example
     * @queryParam per_page int Le nombre de résultats par page.Example: 5
     * @queryParam sort_by string L'ordre de tri. No-example
     *
     * @return PageableResource
     */
    public function index(Request $request)
    {
        $communes = Commune::query();

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('communes', $key)) {
                if (Str::contains($key, '_id')) {
                    $communes->where($key, $value);
                }
                $communes->where($key, 'LIKE', "%{$value}%");
            }
        }

        $communes->orderBy('nom', $request->sort_by ?? 'asc');
        $communes = $communes->paginate($request->per_page ?? Commune::count());

        return new PageableResource(CommuneResource::collection($communes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommuneRequest $request
     * @return Response
     */
    public function store(StoreCommuneRequest $request)
    {
        //
    }

    /**
     * Afficher une commune.
     *
     * @param Commune $commune
     * @return CommuneResource
     */
    public function show(Commune $commune)
    {
        return new CommuneResource($commune);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommuneRequest $request
     * @param Commune $commune
     * @return Response
     */
    public function update(UpdateCommuneRequest $request, Commune $commune)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Commune $commune
     * @return Response
     */
    public function destroy(Commune $commune)
    {
        //
    }
}
