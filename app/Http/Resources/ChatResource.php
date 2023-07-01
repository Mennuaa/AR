<?php

namespace App\Http\Resources;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sender = User::find($this->sender_id);
        $receiver = User::find($this->receiver_id);
        $messages = Message::where("conversation_id", $this->id)->get();
        return [
            "id"=>$this->id,
            "sender"=>$sender,
            "receiver"=>$receiver,
            "messages"=>$messages,
        ];
    }
}
