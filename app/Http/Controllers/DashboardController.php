<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        
        return view('home', [
            'roomCount' => Room::count(),
            'userCount' => User::count(),
        ]);

    }
}
