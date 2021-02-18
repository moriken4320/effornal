<?php

namespace App\Http\Controllers;

use App\Room;
use Auth;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('roomUserCheck');
    }

    public function index(Room $room)
    {
        $auth_user = Auth::user();

        $opponent_user = $room->getOpponent($auth_user);

        $room_messages = $room->roomMessage()->orderBy('created_at','asc')->with('user')->get();
        
        return view('room.message.index', ['opponent_user_name'=>$opponent_user->name, 'room_messages'=>$room_messages]);
    }
}
