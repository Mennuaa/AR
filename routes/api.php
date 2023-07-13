<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CollectionController;
use App\Http\Controllers\API\BoxController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\FilmController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\StudiosEurogroupManagersController;
use App\Http\Controllers\API\WishListController;
use App\Http\Controllers\PusherAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Auth

Route::post('/auth/signup', [AuthController::class, 'signUp'])->name('signup.api');
Route::post('/auth/signin', [AuthController::class, 'signIn'])->name('signin.api');

# User

# get user
Route::get('/user/{id}', [UserController::class, "getUser"])
->middleware('auth:sanctum')
->name('getUser');

# change user
Route::put('/user/{id}', [UserController::class, "updateProfile"])
->middleware('auth:sanctum')
->name('updateUser');

# change password

Route::put('/user/changepass/{id}', [UserController::class, "changePassword"])
->middleware('auth:sanctum')
->name('changePassword');




Route::resources([

    # Collections 

    '/collections' => CollectionController::class,
    '/collections/create' => CollectionController::class,

    # Boxes

    '/box' => BoxController::class,
    '/box/create' => BoxController::class,

    # Films

    '/film' => FilmController::class,
    '/film/create' => FilmController::class,

    # Requests

    "/requests" => RequestController::class,
]);

# Wishlist

# get wishlist

Route::get('/wishlist', [WishListController::class, 'get'])
->name('getWishlist')
->middleware('auth:sanctum');

# add to wishlist

Route::post('/wishlist/add', [WishListController::class, 'add'])
->name('addToWishlist')
->middleware('auth:sanctum');

Route::post('/add-manager/{id}', [StudiosEurogroupManagersController::class, 'studioManagers'])->middleware('auth:sanctum')->name('addManager');

Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('api.send-message');
Route::get('/chats', [ChatController::class, 'chats'])->middleware('auth:sanctum')->name('api.chats');
Route::get('/chat/{id}', [ChatController::class, 'chat'])->middleware('auth:sanctum')->name('api.chat');

Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate']);
