<?php

namespace App\Http\Resources;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
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
            "name" => $this->name,
            "box_id" => $this->box_id,
            "text" => $this->text,
            "image" => $this->image,
            "films" => FilmResource::collection(Film::where('collection_id', $this->id)->get())
        ];
    }
}
