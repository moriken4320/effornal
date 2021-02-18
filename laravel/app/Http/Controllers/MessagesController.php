<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomMessage;
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
        
        return view('room.message.index', ['room'=>$room,'opponent_user_name'=>$opponent_user->name, 'room_messages'=>$room_messages]);
    }

    public function create(Request $request, Room $room)
    {
        // RoomMessageモデル作成
        $room_message = new RoomMessage(); 
        $room_message->fill($request->all());
        $room_message->room_id = $room->id;
        $room_message->user_id = Auth::user()->id;
        $room_message->save();

        return back();
    }
}
