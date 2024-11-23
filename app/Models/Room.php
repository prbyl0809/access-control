<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_path'];

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'position_room');
    }

    public function userRoomEntries()
    {
        return $this->hasMany(UserRoomEntry::class);
    }
}
