<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostalCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'postal_code' => $this->postal_code,
            'city_id'     => $this->city_id,
            'city'        => $this->city ? new CityResource($this->city) : null,
        ];
    }
}
