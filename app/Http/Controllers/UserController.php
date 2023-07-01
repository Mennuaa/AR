<?php

namespace App\Http\Controllers;

use App\Models\StudioUsers;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function resetProfile(Request $request, $id){
        // dd($request->all());
        $user = User::find($id);
        if($request->has('prev_password') && $request->prev_password !== null){
            if(Hash::check($request->prev_password, Auth::user()->password)){
                if($request->password === $request->re_password){
                    $user->password = Hash::make($request->password);
                }else if($request->password !== $request->re_password){
                    return back()->with('notCorrectRePass', 'write correct password confirmation');
                }
            }else{
                return back()->with('notCorrectPrevPass', "Previous password is not correct");
            }
        }
        $user->name = $request->name;
    //     if($request->email !== $user->email){
    //         $email = User::where('email',$request->email)->first();
    //         if($email != null){
    //          return back()->with('emailExist', 'User with exact email exist');
    //         }else{
                
    //     $user->email = $request->email;
    // }
    //     }
    if($request->has('address') || $request->has('working_time')|| $request->has('studio_name') ){
       $studio_user = StudioUsers::where('user_id', $user->id)->first();
       $studio_user->address = $request->address;
       $studio_user->working_time = $request->working_time;
       $studio_user->studio_name = $request->studio_name;
       $studio_user->save();
    }
        $image = $user->image;
        if($request->has('image')){
            $fileName = $request->file('image')->getClientOriginalName();
            $newName = time() . "-" . $fileName;
            $request->file('image')->move(public_path('/img/user'), $newName);
            $image = url('/img/user/'.$newName);
        }
        // $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image = $image;
        $user->update();
        return back()->with('profileChangeSuccess', 'Profile has been updated successfully');
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect(route('signin'));
    }
}
