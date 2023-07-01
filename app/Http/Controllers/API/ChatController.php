<?php

namespace App\Http\Controllers\API;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request){
        $user = User::find(1);

        $receiver = User::find($request->receiverInstance);
        $conversation = Conversation::find($request->selectedConversation);

        $createdMessage = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => 1,
            'receiver_id' => $receiver->id,
            'body' => $request->body,
        ]);
    
        broadcast(new MessageSent($user, $createdMessage, $conversation, $receiver));
        return $createdMessage;
    }

    public function chats(){
        $user = Auth::user();
        $chats = Conversation::where("sender_id", $user->id)->orWhere("receiver_id",$user->id)->get();
        return $chats;
    }
    public function chat($id){
        $chat = Conversation::find($id);
        return ChatResource::make($chat);
    }
}
