<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $auth_user = Auth::user();
        $rooms = $auth_user->rooms;
        $rooms->transform(function($room) use($auth_user){
            $room->opponent_user =  $room->getOpponent($auth_user);
            return $room;
        });
        return view('room.index', ['rooms'=>$rooms]);
    }
}
