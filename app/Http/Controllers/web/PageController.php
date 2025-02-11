<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome() {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
    public function dashboard(){
        return Inertia::render('Dashboard');
    }
    public function chat(){
        return Inertia::render('Chat');
    }
    public function pusher(){
        return view('index');
    }
}
