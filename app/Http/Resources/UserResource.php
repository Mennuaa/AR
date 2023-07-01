<?php

namespace App\Http\Resources;

use App\Models\Film;
use App\Models\UserRoles;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $wishlists = Wishlist::where("user_id", $this->id)->get();
        $films = [];
        foreach($wishlists as $wishlist){
            $film = Film::where("id", $wishlist->film_id)->first();
            array_push($films, $film);
        }
        return [
            "id" => $this->id,
            "name" => $this->name,
            "image" => $this->image,
            "email" => $this->email,
            "phone" => $this->phone,
            "role" => UserRoles::where('id', $this->role_id)->first()->name,
        ];
    }
}
