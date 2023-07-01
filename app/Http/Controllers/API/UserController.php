<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerResource;
use App\Http\Resources\StudioResource;
use App\Http\Resources\UserResource;
use App\Models\StudiosManager;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUser($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                "message"=> 'user is not found'
            ], 404);
        }
        if($user){
            if($user->role_id == 3){
                $response = [
                    "status" => true,
                    "user" => StudioResource::make($user)
                ];
            return response($response, 200);
            }else if($user->role_id == 2){
                dd(StudiosManager::where('manager_id',9));
                $response = [
                    "status" => true,
                    "user" => ManagerResource::make($user)
                ];
                return response($response, 200);
            }
            $response = [
                "status" => true,
                "user" => UserResource::make($user)
            ];
            return response($response, 200);
        }
    }

    public function updateProfile(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                "message"=> 'user not found'
            ], 404);
        }
        if($user->id == $request->user()->id){
           
            $user->update($request->all());
            $response = [
                "message" =>"Profile updated successfully",
                "user" => $user
            ];
            return response($response, 200);
        }
    }
    public function changePassword(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json([
                "message"=> 'user not found'
            ], 404);
        }
        
        if($user->id == $request->user()->id){
            if($request->has('password')){
                    if($request->has("new_password")){
                        if($request->new_password == $request->confirm_password){
                            $user->password = Hash::make($request->new_password);
                            $user->update();
                        }else{
                            return response()->json([
                                "message"=> 'password confirmation is not right'
                            ], 200);
                        }
                    }else{
                        return response()->json([
                            "message"=> 'write new password'
                        ], 200);
                    }
            }else{
                return response()->json([
                    "message"=> 'previous password didnt found'
                ], 200);
            }
            $response = [
                "status" => true,
                "user" => $user
            ];
            return response($response, 200);
        }
    }
}
