<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\UserRoomEntry;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    public function showForm()
    {
        $users = User::whereNotNull('card_number')->get();

        return view('simulation.form', [
            'users' => $users,
            'rooms' => Room::all(),
        ]);
    }

    public function simulateEntry(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $user = User::find($request->input('user_id'));
        $room = Room::find($request->input('room_id'));

        $canEnter = $user->position && $room->positions->contains($user->position->id);

        UserRoomEntry::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'successful' => $canEnter,
        ]);

        if ($canEnter) {
            return redirect()->back()->with('success', 'Sikeres belépés a szobába.');
        } else {
            return redirect()->back()->with('error', 'Sikertelen belépés, nincs jogosultság.');
        }
    }
}
