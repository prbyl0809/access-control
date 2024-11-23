<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoomEntry extends Model
{
    /** @use HasFactory<\Database\Factories\UserRoomEntryFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'successful'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
