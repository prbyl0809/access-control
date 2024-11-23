<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Room;
use App\Models\UserRoomEntry;
use Illuminate\Http\Request;
use Storage;
use Str;

class RoomController extends Controller
{
    public function index()
    {
        return view('rooms.index', [
            'rooms' => Room::all()
        ]);
    }

    public function create()
    {
        return view('rooms.create', [
            'positions' => Position::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'positions' => 'nullable|array',
            'positions.*' => 'exists:positions,id',
        ]);

        $image_path = '';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_path = 'image_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($image_path,$file->get());
        }

        $room = Room::factory()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image_path' => $image_path === '' ? null : $image_path,
        ]);

        $room->positions()->attach($request->input('positions'));

        return redirect()->route('rooms.index');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', [
            'room' => $room,
            'positions' => Position::all(),
        ]);
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'positions' => 'nullable|array',
            'positions.*' => 'exists:positions,id',
        ]);

        $image_path = $room->image_path;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_path = 'image'.Str::random(10).'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($image_path,$file->get());
        }

        if($image_path != $room->image_path && $room->image_path != null) {
            Storage::disk('public')->delete($room->image_path);
        }

        $room->name = $validated['name'];
        $room->description = $validated['description'] ?? $room->description;
        $room->save();

        $room->positions()->sync($validated['positions'] ?? []);

        return redirect()->route('rooms.index');
    }

    public function destroy(Room $room)
    {
        if ($room->image_path) {
            Storage::disk('public')->delete($room->image_path);
        }

        $room->delete();

        return redirect()->route('rooms.index');
    }

    public function entries(Room $room)
    {
        $entries = UserRoomEntry::where('room_id', $room->id)
            ->with('user.position')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rooms.entries', [
            'room' => $room,
            'entries' => $entries
            ]);
    }
}
