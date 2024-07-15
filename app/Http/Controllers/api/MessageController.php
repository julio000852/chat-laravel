<?php

namespace App\Http\Controllers\api;

use App\Events\Chat\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{

    public function listMessages(User $user)
    {
        $userfrom = Auth::user()->id;
        $userTo = $user->id;

        $messages = Message::where(
            function($query) use($userfrom, $userTo)
            {
                $query->where([
                    'From'=> $userfrom,
                    'To'=>$userTo
                ]);
            }
        )->orwhere(
            function($query) use($userfrom, $userTo)
            {
                $query->where([
                    'From'=> $userTo,
                    'To'=>$userfrom
                ]);
            }
        )->orderby('created_at', 'ASC')
        ->get();
        return response()->json([
            'message' => $messages
        ], Response::HTTP_OK);
    }
    public function store(Request $request){
        $messages = new Message();
        $messages->from = Auth::user()->id;
        $messages->to = $request->to;
        $messages->content = filter_var($request->content, FILTER_SANITIZE_STRIPPED);
        $messages->save();

        Event::dispatch(new SendMessage($messages, $request->to));
    }

}
