<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::withCount('users')->get();

        return view('positions.index', [
            'positions' => $positions
        ]);
    }

    public function create()
    {
        return view(view: 'positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:positions,name',
        ]);

        Position::factory()->create([
            'name' => $validated['name']
        ]);

        return redirect()->route('positions.index');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', [
            'position' => $position
        ]
    );
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:positions,name,',
        ]);

        $position->name = $validated['name'];

        $position->save();

        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index');
    }

    public function users(Position $position)
    {
        $users = $position->users;

        return view('positions.users', [
            'position' => $position,
            'users' => $users
        ]);
    }
}
