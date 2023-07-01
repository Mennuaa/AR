<?php

namespace App\Http\Resources;

use App\Models\Film;
use App\Models\StudiosManager;
use App\Models\StudioUsers;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $wishlists = Wishlist::where("user_id", $this->id)->get();
        $studio_user = StudioUsers::where("user_id", $this->id)->first();
        $films = [];
        foreach($wishlists as $wishlist){
            $film = FilmResource::make(Film::where("id", $wishlist->film_id)->first());
            array_push($films, $film);
        }
        return [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "image" => $this->image,
            "manager" => StudiosManager::where("studio_id",$this->id)->first(),
            "address" => $studio_user->address,
            "working_time" => $studio_user->working_time,
            "studio_name" => $studio_user->studio_name,
            "wishlist" => $films
        ];
    }
}
