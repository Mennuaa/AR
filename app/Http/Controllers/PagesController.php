<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Http\Middleware\StudioManager;
use App\Models\Film;
use App\Models\Request as ModelsRequest;
use App\Models\StudiosManager;
use App\Models\StudioUsers;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    # Sign In
    
    public function signin(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->role_id == 2){
                return redirect(route('manager.home'));
            }else if($user->role_id == 3){
                return redirect(route('studios.home'));
            }
        }
            return view('containers.auth.signin');
    }

    # Manager 

    public function Dashboard(){
        $user = Auth::user();
        $role = UserRoles::where('id', $user->role_id)->first()->name;
        if($user->role_id == 3){
            $studio_user = StudioUsers::where('user_id', $user->id)->first();
            return view('containers.dashboard', compact('user', 'role', 'studio_user'));
        }
        return view('containers.dashboard', compact('user', 'role'));
    }

    public function ManagerRequests(Request $request){
        $user = auth()->user();
        $films = Film::all();
        $users = User::all();
        $requests  =ModelsRequest::where("manager_id", $user->id)->orderBy('id','DESC')->get();
        if($request->filter == "done"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->where('request_status', 'Заявка выполнена')->orderBy('id','DESC')->get();
       }elseif($request->filter == "all"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->orderBy('id','DESC')->get();
       }elseif($request->filter == "accept"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->where('request_status', 'Резерв подтвержден')->orderBy('id','DESC')->get();
       }elseif($request->filter == "dontaccept"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->where('request_status', 'Резерв не подтвержден')->orderBy('id','DESC')->get();
       }elseif($request->filter == "canceled"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->where('request_status', 'Заявка отменена')->orderBy('id','DESC')->get();
       }elseif($request->filter == "reserv"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->where('request_status', 'В резервации')->orderBy('id','DESC')->get();
       }elseif($request->filter == "doing"){
        $requests  =ModelsRequest::where("manager_id", $user->id)->where('request_status', 'Запрос в обработке')->orderBy('id','DESC')->get();
       }
       $studios = StudiosManager::where("manager_id", $user->id)->get();
        return view('containers.manager.manager-request', [
            'user'=>$user,
            'users'=>$users,
            "requests"=> $requests,
            "films" => $films,
            "studios" => $studios
        ]);
    }

    # Studios

    public function StudiosRequest(){
        $user = auth()->user();
        $manager = StudiosManager::where('studio_id', $user->id)->first();
        $manager = User::where('id', $manager->manager_id)->first();
        $requests = ModelsRequest::where('user_id', $user->id)->orderBy('id','DESC')->get();
        $films = Film::all();
        return view('containers.studio.studios-requests', [
            'user'=> $user,
            'manager'=>$manager,
            "requests" => $requests,
            "films" => $films
        ]);
    }



    public function chat_list(){
        $user = auth()->user();
        if($user->role_id == 2){
            return view('containers.studio.chat-list', ['user'=> $user]);
        }else if($user->role_id == 3){
            $manager = StudiosManager::where('studio_id', $user->id)->first();
            $manager = User::where('id', $manager->manager_id)->first();
            return view('containers.studio.chat-list', ['user'=> $user, 'manager'=>$manager]);
        }
      
    }

    public function ManagerStutudios(){
        $user = auth()->user();
        $studios = StudiosManager::where("manager_id", $user->id)->get();
        $users = User::all();
        $studio_users = StudioUsers::all();
        return view('containers.manager.studios', ["studios"=>$studios, "users"=>$users,'studio_users'=>$studio_users]);
    }
}
