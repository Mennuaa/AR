<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerResource;
use App\Models\StudiosManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudiosEurogroupManagersController extends Controller
{
    public function studioManagers(Request $request, $id){
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'manager_id' => 'required'
        ]);
        if($validator->fails()){
            $response = [
                'success' => true,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $studio = StudiosManager::where('studio_id', $user->studio_id)->first();
        if($studio){
            $response = [
                'success' => true,
                'studio manager' => ManagerResource::make(User::where('id', $studio->manager_id)->first())
            ];
            return response()->json($response, 200);
        }
        $create = StudiosManager::create([
            'manager_id'=>$request->manager_id,
            "studio_id"=>$user->id
        ]);
        if($create){
            $response = [
                'success' => true,
                'message' => "Manager added for studio"
            ];
            return response()->json($response, 200);
        }
    }
}
