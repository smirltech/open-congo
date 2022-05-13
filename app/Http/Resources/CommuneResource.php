<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CommuneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom' => Str::title($this->nom),
            'habitants' => $this->nombre_habitants,
            'hotels' => $this->nombre_hotels,
            'restaurants' => $this->nombre_restaurants,
            'maps' => $this->maps,
            'quartiers' => $this->quartiers->count(),
            'ville' => Str::title($this->ville->nom),
        ];
    }
}
