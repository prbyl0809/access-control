<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'phone_number',
        'card_number',
        'position_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function userRoomEntries()
    {
        return $this->hasMany(UserRoomEntry::class);
    }
}
