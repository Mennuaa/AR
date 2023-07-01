<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\Film;
use App\Models\Message;
use App\Models\Request as ModelsRequest;
use App\Models\StudiosManager;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Popup extends Component
{ 
    public $users;
    public $size;
    public $quantity;
    public $message= 'hello how are you ';
    protected $listeners = [
        'sendRequest',
        'checkConversation',
        'getQuantity',
        'getSize'
    ];
    public $film;
    public function sendRequest($element,$quantity,$size){
        $this->quantity = $quantity;
        $this->size = $size;
        $this->film = Film::where('id',  $element['id'])->first();
        $this->emitSelf('checkConversation', StudiosManager::where("studio_id", auth()->id())->first()->manager_id);
        return redirect('/chat');
    }
    public function checkConversation($receiverId)
    {
        // dd($receiverId);

        $checkedConversation = Conversation::where('receiver_id', auth()->user()->id)->where('sender_id', $receiverId)->orWhere('receiver_id', $receiverId)->where('sender_id', auth()->user()->id)->first();

        if (!$checkedConversation) {


            $createdConversation= Conversation::create(['receiver_id'=>$receiverId,'sender_id'=>auth()->user()->id,'last_time_message'=>0]);
          /// conversation created 

            $createdMessage= Message::create(
                [
                'conversation_id'=>$createdConversation->id,
                'sender_id'=>auth()->user()->id,
                'receiver_id'=>$receiverId,
                'body'=>$this->film->image, 
                "type" => "request",
                ]
            );
            $createdRequest = ModelsRequest::create([
                "user_id" => auth()->user()->id,
                "film_id" => $this->film->id,
                "size" => $this->size,
                "quantity" => $this->quantity,
                "request_status" => "Запрос в обработке",
                "message_id" => $createdMessage->id,
                "manager_id" => StudiosManager::where("studio_id", auth()->user()->id)->first()->manager_id
            ]);


        $createdConversation->last_time_message= $createdMessage->created_at;
        $createdConversation->save();

        return back();
        dd('saved');




        } else {
            $createdConversation= $checkedConversation;

            $createdMessage= Message::create(
                [
                'conversation_id'=>$createdConversation->id,
                'sender_id'=>auth()->user()->id,
                'receiver_id'=>$receiverId,
                'body'=>$this->film->image, 
                "type" => "request",
                ]
            );

            $createdRequest = ModelsRequest::create([
                "user_id" => auth()->user()->id,
                "film_id" => $this->film->id,
                "size" => $this->size,
                "quantity" => $this->quantity,
                "request_status" => "Запрос в обработке",
                "message_id" => $createdMessage->id,
                "manager_id" => StudiosManager::where("studio_id", auth()->user()->id)->first()->manager_id
            ]);
        $createdConversation->last_time_message= $createdMessage->created_at;
        $createdConversation->save();
        }
        return back();
        # code...
    }
    public function render()
    {
        $user = auth()->user();
        $manager = StudiosManager::where('studio_id', $user->id)->first();
        $manager = User::where('id', $manager->manager_id)->first();
        return view('livewire.popup', ['user'=> $user, 'manager'=>$manager]);
    }
}
