<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinceRequest;
use App\Http\Resources\PageableResource;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProvinceController extends Controller
{
    /**
     * Display a listing of provinces.
     *
     *
     * @return PageableResource
     */
    public function index(ProvinceRequest $request)
    {
        $provinces = Province::query();

        foreach ($request->validated() as $column => $value) {
            $op = "LIKE";
            if (Schema::hasColumn('provinces', $column)) {
                $provinces->where($column, $op, "%{$value}%");
            }
        }

        $provinces->orderBy('nom', $request->order_by ?? 'asc');
        $provinces = $provinces->paginate($request->per_page ?? 26);

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
