<?php

namespace App\Http\Resources;

use App\Models\Collections;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "collection" => Collections::where("id", $this->collection_id)->first(),
            "name" => $this->name,
            "creator" => $this->creator,
            "code" => $this->code,
            "width" => $this->width,
            "height" => $this->height,
            "namotka" => $this->namotka,
            "length" => $this->length,
            "min_order" => $this->min_order,
            "image" => $this->image,
        ];
    }
}
