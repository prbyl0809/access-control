<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLogController extends Controller
{
    public function index()
    {
        $entries = auth()->user()->userRoomEntries()
            ->with('room')
            ->orderBy('created_at', 'desc')
            ->paginate(perPage: 10);

        return view('logs.index', [
            'entries' => $entries
        ]);
    }
}
