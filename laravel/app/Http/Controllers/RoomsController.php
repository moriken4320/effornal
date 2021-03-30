<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    public function index()
    {
        $auth_user = Auth::user();
        $rooms = $auth_user->rooms;
        $rooms->transform(function ($room) use ($auth_user) {
            $room->opponent_user = $room->getOpponent($auth_user);

            return $room;
        });

        return view('room.index', ['rooms'=>$rooms]);
    }

    public function new()
    {
        $auth_user = Auth::user();
        $rooms = $auth_user->rooms;
        $relations = $auth_user->getFriends();
        $relations = $relations->transform(function ($relation) use ($auth_user, $rooms) {
            $user = $relation;
            $rooms->each(function ($room) use ($auth_user, $relation, &$user) {
                if ($room->getOpponent($auth_user)->id == $relation->id) {
                    $user = null;
                }
            });

            return $user;
        })->reject(function ($user) {
            return $user == null;
        });

        return view('room.new', ['relations'=>$relations]);
    }

    public function create(User $user)
    {
        $check = false;
        Auth::user()->rooms->each(function ($room) use (&$check, $user) {
            if ($room->users()->where('user_id', $user->id)->first() != null) {
                return $check = true;
            }
        });
        if ($check) {
            return back();
        }
        DB::beginTransaction();
        try {
            $room = Room::create();
            $room->users()->detach(Auth::user()->id);
            $room->users()->attach(Auth::user()->id);
            $room->users()->detach($user->id);
            $room->users()->attach($user->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return back();
        }

        return redirect(route('rooms.messages.index', ['room'=>$room]));
    }
}
