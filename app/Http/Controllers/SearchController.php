<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageableResource;
use App\Models\Commune;
use App\Models\Pays;
use App\Models\Province;
use App\Models\Ville;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    /**
     * Rechercher une province, ville, commune par son nom.
     * @queryParam q Le mot clé de recherche. Example:Lubu
     * @queryParam limit in Le nombre de résultats à retourner. Example: 3
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string',
            'limit' => 'nullable|integer|min:3|max:50',
        ]);

        $data = [];
        $limit = $request->limit ?? 10;

        $pays = Pays::where('nom', 'like', '%' . $request->q . '%')
        ->orderBy('nom', 'asc')
        ->limit($limit)->get();

        $provinces = Province::where('nom', 'like', '%' . $request->q . '%')
            ->orderBy('nom', 'asc')
            ->limit($limit)->get();


        $limit = $limit - $provinces->count();
        $villes = Ville::where('nom', 'like', '%' . $request->q . '%')
            ->orderBy('nom', 'asc')
            ->limit($limit)->get();


        $limit = $limit - $villes->count();
        $communes = Commune::where('nom', 'like', '%' . $request->q . '%')
            ->orderBy('nom', 'asc')
            ->limit($limit)->get();


            foreach ($pays as $pay) {
                $data[] = [
                    'id' => $pay->id,
                    'nom' => $pay->nom,
                    'type' => 'pays',
                ];
            }

        foreach ($provinces as $province) {
            $data[] = [
                'id' => $province->id,
                'nom' => $province->nom,
                'type' => 'province',
            ];
        }

        foreach ($villes as $ville) {
            $data[] = [
                'id' => $ville->id,
                'nom' => $ville->nom,
                'type' => 'ville',
            ];
        }

        foreach ($communes as $commune) {
            $data[] = [
                'id' => $commune->id,
                'nom' => $commune->nom,
                'type' => 'commune',
            ];
        }
        return Response::json($data);
    }
}
