<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinceRequest;
use App\Http\Resources\PageableResource;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProvinceController extends Controller
{
    /**
     * Display a listing of provinces.

     * @queryParam nom The keyword to search for. No-example
     * @queryParam page int The page number. No-example
     * @queryParam per_page int The number of provinces on a page. No-example
     * @queryParam sort_by string The order to sort by, asc or desc. No-example
     *
     * @return PageableResource
     */
    public function index(Request $request)
    {
        $provinces = Province::query();

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('provinces', $key)) {
                if (Str::contains($key, '_id')) {
                    $provinces->where($key, $value);
                }
                $provinces->where($key, 'LIKE', "%{$value}%");
            }
        }

        $provinces->orderBy('nom', $request->sort_by ?? 'asc');
        $provinces = $provinces->paginate($request->per_page ?? Province::count());

        return new PageableResource(ProvinceResource::collection($provinces));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProvinceRequest $request
     * @return Response
     */
    public function store(StoreProvinceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Province $province
     * @return Response
     */
    public function show(Province $province)
    {
        return ProvinceResource::make($province);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProvinceRequest $request
     * @param Province $province
     * @return Response
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Province $province
     * @return Response
     */
    public function destroy(Province $province)
    {
        //
    }
}
