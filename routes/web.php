<?php

use App\Http\Controllers\web\PageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PageController::class, 'welcome'])->name('welcome');

Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified',]], function() {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/chat', [PageController::class, 'chat'])->name('chat');
    Route::get('/pusher', [PageController::class, 'pusher'])->name('pusher');
});
