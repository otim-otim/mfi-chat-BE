<?php

use App\Http\Controllers\ClientControllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/login',[AuthController::class,'login'])->name('client.login');
Route::post('auth/register',[AuthController::class,'register'])->name('client.register');
// Route::post('/client/auth/register',[AuthController::class,'register'])->name('client.register');

Route::middleware([
    'auth:api',
   
])->group(function () {
   

    //chat routes
    Route::get('chats/index',[ChatController::class,'index'])->name('chat.index');
    Route::get('chat/show/{chat}' ,[ChatController::class,'show'])->name('chat.show');
    Route::post('chat/store/{id}' ,[ChatController::class,'store'])->name('chat.store');

    //message routes
    Route::post('chat/message/send',[MessageController::class,'store'])->name('message.store');
});
