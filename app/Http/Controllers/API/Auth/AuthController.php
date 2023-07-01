<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\StudioUsers;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $photoUrl = '';
        if($request->file('image')){
            $fileName = $request->file('image')->getClientOriginalName();
            $newName = time() . "-" . $fileName;
            $request->file('image')->move(public_path('/img/user'), $newName);
            $photoUrl = url('/img/user/'.$newName);
        }
        $input = [
                "email" => $request->email,
                "name" => $request->name,
                "phone" => (int)$request->phone,
                "image" => $photoUrl,
                "role_id" => UserRoles::where('name', $request->role)->first()->id,
                "password" => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ];
        
        if(User::where('email', $request->email)->first()){
            $response = [
                'success' => false,
                'message' => 'User with exact email exists'
            ];
            return response()->json($response, 200);
        }

        $user = User::create($input);
        if($request->role == 'студия'){
            StudioUsers::create(['address'=>$request->address,'working_time'=>$request->working_time,'studio_name'=>$request->studio_name, "user_id"=>$user->id]);
        }
        if($user) {
        $success['token'] = $user->createToken('Chattydate')->plainTextToken;
        $success['name'] = $user->name;
        Auth::login($user);
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User registrated successfully'
        ];
        return response()->json($response, 200);
     }
             $response = [
            'success' => false,
            'message' => 'User cant registrate'
        ];
     return response()->json($response, 400);
    }

    public function signIn(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = Auth::user();
        $success['token'] = $user->createToken('Chattydate')->plainTextToken;
        $success['name'] = $user->name;
        $success['id'] = $user->id;
        auth()->login($user);
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User logged in successfully'
        ];
        return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Unauthorized',
            ];
            return response()->json($response, 400);
        }
    }
}
