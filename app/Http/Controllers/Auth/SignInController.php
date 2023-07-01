<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function signin(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            if($user->role_id == 2){
                return redirect(route('manager.home'));
            }else if($user->role_id == 3){
                return redirect(route('studios.home'));
            }
        }
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return back()->with('notCorrectEmail', 'User with exact email dont exist');
        }

        $formFields = $request->only(['email', 'password']);
        if(Auth::attempt($formFields)){
            session(['user_image' => $user->image]);
            session(['user_name' => $user->name]);
            return redirect(route('manager.home'));
        }
        if($user->first() != null){
            if($user->first()['password'] != $request->password){
                return back()->with('notCorrectPass', 'Not correct password');
            }
        }
        return redirect('/auth/signin')->withErrors([
            'email' => 'Not correct password'
        ]);
    }
}
