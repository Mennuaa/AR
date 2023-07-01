<?php

namespace App\Http\Livewire\Chat;

use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SendMessage extends Component
{
    use WithFileUploads;
    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $file;
    public $createdMessage;
    protected $listeners = ['updateSendMessage', 'sendMessageFile', 'dispatchMessageSent','resetComponent'];

    public function sendMessageFile($file){
        dd($file);
        $store = $this->file->store('files', 'public');
        $name = url('/storage' . "/" .  $store);
       if($this->file->extension() == "jpg" ||$this->file->extension() == "png" || $this->file->extension() == "webp" ){
        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $name,
            'type' => "image"
        ]);
       }else{
        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $name,
            'type' => "file"
        ]);
       }
        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();
        $this->emitTo('chat.chatbox', 'pushMessage', $this->createdMessage->id);


        //reshresh coversation list 
        $this->emitTo('chat.chat-list', 'refresh');
        $this->reset('file');

        $this->emitSelf('dispatchMessageSent');
        
    }
    public function resetComponent()
    {
   
  $this->selectedConversation= null;
  $this->receiverInstance= null;
 
        # code...
    }
  

    
    function updateSendMessage(Conversation $conversation, User $receiver)
    {

        //  dd($conversation,$receiver);
        $this->selectedConversation = $conversation;
        $this->receiverInstance = $receiver;
        # code...
    }




    public function sendMessage()
    {
        if ($this->body == null) {
            return null;
        }
      
        $this->createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
        ]);
    

        $this->selectedConversation->last_time_message = $this->createdMessage->created_at;
        $this->selectedConversation->save();
        $this->emitTo('chat.chatbox', 'pushMessage', $this->createdMessage->id);


        //reshresh coversation list 
        $this->emitTo('chat.chat-list', 'refresh');
        $this->reset('body');

        $this->emitSelf('dispatchMessageSent');
        
        // dd($this->body);
        # code..
    }



    public function dispatchMessageSent()
    {

        broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->selectedConversation, $this->receiverInstance));
        # code...
    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
