<?php

namespace App\Http\Resources;

use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = UserResource::make(User::find($this->user_id));
        $film = Film::find($this->film_id);
        return [
            "id" => $this->id,
            "user" => $user,
            "request_status" => $this->request_status,
            "film" => $film,
            "size" => $this->size,
            "quantity" => $this->quantity,
        ];
    }
}
