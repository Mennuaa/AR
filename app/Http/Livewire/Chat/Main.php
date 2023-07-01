<?php

namespace App\Http\Livewire\Chat;

use App\Models\StudiosManager;
use App\Models\User;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        $user = auth()->user();
        if($user->role_id == 3){
        $manager = StudiosManager::where('studio_id', $user->id)->first();
        $manager = User::where('id', $manager->manager_id)->first();
        return view('livewire.chat.main', ['user'=> $user, 'manager'=>$manager]);
        }else{
            return view('livewire.chat.main', ['user'=> $user]);
        }
    }
}
