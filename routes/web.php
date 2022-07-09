<?php

use Inertia\Inertia;

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




use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

 Auth::routes();
Route::middleware([
    'auth:web',
  
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');

    Route::get('/', function () {
        return view('welcome');
    });
    
   
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //chat routes
    Route::get('chats/index',[ChatController::class,'index'])->name('chat.index');
    Route::get('chat/show/{chat}' ,[ChatController::class,'show'])->name('chat.show');
    Route::get('chat/create' ,[ChatController::class,'create'])->name('chat.create');
    Route::post('chat/store/{id}' ,[ChatController::class,'store'])->name('chat.store');

    //message routes
    Route::post('chat/message/send',[MessageController::class,'store'])->name('message.store');
});


