<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::resource('users', UserController::class);
Route::get('/users/{user}/entries', [UserController::class, 'entries'])->name('users.entries');

Route::resource('positions', PositionController::class)->except(['show']);

Route::get('/positions/{position}/users', [PositionController::class, 'users'])->name('positions.users');

Route::resource('rooms', RoomController::class)->except(['show']);

Route::get('/rooms/{room}/entries', [RoomController::class, 'entries'])->name('rooms.entries');

Route::get('/simulate-entry', [SimulationController::class, 'showForm'])->name('simulate-entry.form');
Route::post('/simulate-entry', [SimulationController::class, 'simulateEntry'])->name('simulate-entry.process');

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::get('/logs', [UserLogController::class, 'index'])->name('user.logs');

Auth::routes();