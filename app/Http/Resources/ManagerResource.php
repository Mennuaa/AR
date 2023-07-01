<?php

namespace App\Http\Resources;

use App\Models\Film;
use App\Models\StudiosManager;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
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
            $film = FilmResource::make(Film::where("id", $wishlist->film_id)->first());
            array_push($films, $film);
        }
        return [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "image" => $this->image,
            "studios" => StudiosManager::where('manager_id',$this->id),
            "wishlist" => $films
        ];
    }
}
