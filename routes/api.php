<?php

use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/user/me', [UserController::class, 'me'])->name('users.me');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/message/{user}', [MessageController::class, 'listMessages'])->name('message.listMessage');
    Route::post('/message/store', [MessageController::class, 'store'])->name('message.store');
});
