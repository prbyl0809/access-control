<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\UserRoomEntry;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('position')->get();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {

        return view('users.create', [
            'positions' => Position::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'card_number' => 'required|string|size:16|unique:users,card_number',
            'position_id' => 'required|exists:positions,id',
            'admin' => 'nullable|boolean',
        ]);

        $validated['admin'] = $request->has('admin') ? true : false;

        $user = User::factory()-> create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
            'card_number' => $validated['card_number'],
            'position_id' => $validated['position_id'],
            'admin' => $validated['admin'],
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $positions = Position::all();

        return view('users.edit', compact('user', 'positions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'card_number' => 'required|string|size:16|unique:users,card_number,' . $user->id,
            'position_id' => 'required|exists:positions,id',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'card_number' => $request->input('card_number'),
            'position_id' => $request->input('position_id'),
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function entries(User $user)
    {
        return view('users.entries', [
            'user' => $user,
            'entries' => UserRoomEntry::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
