<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PageableResource extends ResourceCollection
{

    private $meta;

    public function __construct($resource)
    {
        $this->meta = [
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'first_item' => $resource->firstItem(),
            'last_item' => $resource->lastItem(),
            'last_page' => $resource->lastPage(),
            'total' => $resource->total(),
        ];

        $resource = $resource->getCollection();
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => $this->meta,
        ];
    }
}
