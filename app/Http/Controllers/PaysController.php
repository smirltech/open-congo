<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaysRequest;
use App\Http\Resources\PageableResource;
use App\Http\Requests\StorePaysRequest;
use App\Http\Requests\UpdatePaysRequest;
use App\Http\Resources\PaysResource;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PaysController extends Controller
{
    /**
     * Afficher tous les pays.

     * @queryParam nom Le nom de la province. No-example
     * @queryParam page int Le numéro de la page à afficher. No-example
     * @queryParam per_page int Le nombre de résultats par page. Example: 5
     * @queryParam sort_by string L'ordre de tri. No-example
     *
     * @return PageableResource
     */
    public function index(Request $request)
    {
        dd($request->all());
        $pays = Pays::query();

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('pays', $key)) {
                if (Str::contains($key, '_id')) {
                    $pays->where($key, $value);
                }
                $pays->where($key, 'LIKE', "%{$value}%");
            }
        }

        $pays->orderBy('nom', $request->sort_by ?? 'asc');
        $pays = $pays->paginate($request->per_page ?? Pays::count());

        return new PageableResource(PaysResource::collection($pays));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePaysRequest $request
     * @return Response
     */
    public function store(StorePaysRequest $request)
    {
        //
    }

    /**
     * Afficher une province.
     *
     * @param Pays $pays
     * @return Response
     */
    public function show(Pays $pay)
    {
        return PaysResource::make($pay);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePaysRequest $request
     * @param Pays $pays
     * @return Response
     */
    public function update(UpdatePaysRequest $request, Pays $pays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pays $pays
     * @return Response
     */
    public function destroy(Pays $pays)
    {
        //
    }
}
