<?php

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Chat\CreateChat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        $user = Auth::user();
        if($user->role_id == 2){
            return redirect(route('manager.home'));
        }else if($user->role_id == 3){
            return redirect(route('studios.home'));
        }
    }
    return view('containers.auth.signin');
});

# Auth

Route::get('/auth/signin', [PagesController::class, 'signin'])->name('signin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

# Sign in

Route::post('/auth/signin', [SignInController::class, 'signin'])->name('signin');

# Manager

Route::get('/dashboard', [PagesController::class, 'Dashboard'])->name('dashboard');
Route::get('/manager/requests', [PagesController::class, 'ManagerRequests'])->name('manager.home')->middleware('eurogroup');
Route::get('/manager/studios', [PagesController::class, 'ManagerStutudios'])->name('manager.studios')->middleware('eurogroup');

# Studios


# Update Profile

Route::put('/user/{id}', [UserController::class, 'resetProfile'])->name('reset_profile');
Route::put('/user/studio/{id}', [UserController::class, 'resetStudioProfile'])->name('reset_studi_profile');

//livewire routes

Route::get('/users',CreateChat::class)->name('users');
Route::get('/chat{key?}',Main::class)->middleware('auth')->name('chat')->middleware('auth');

# Studios 

Route::middleware('studio')->group(function(){
    Route::get('/studios/dashboard', [PagesController::class, 'StudiosRequest'])->name('studios.home');
});


Route::get('/request/{id}', [RequestController::class, 'edit'])->name('request.edit');
Route::put('/request/{id}', [RequestController::class, 'update'])->name('request.edit');

