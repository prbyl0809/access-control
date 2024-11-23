<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PermissionController extends Controller
{
    public function index()
    {
           
        return view('permissions.index', [
            'user' => auth()->user(), 
            'rooms' => auth()->user()->position->rooms,
        ]);
    }
}
