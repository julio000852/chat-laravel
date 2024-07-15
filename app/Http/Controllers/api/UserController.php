<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index (Request $request){
        $userLogger = Auth::user();
        
        $users = User::where('id','!=', $userLogger->id)->get();

        return response()->json([
            'users' => $users
        ], Response::HTTP_OK);
    }

    public function show(User $user)
    {
        return response()->json(['user' => $user], Response::HTTP_OK);
    }
    public function me(){
        $userLogger = Auth::user();

        return response()->json([
            'user' => $userLogger
        ], Response::HTTP_OK);
    }
}
