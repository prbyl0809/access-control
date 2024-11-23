<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Room;
use App\Models\User;
use App\Models\UserRoomEntry;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $positions = Position::factory()->count(5)->create();

        $rooms = Room::factory()->count(5)->create();

        foreach ($positions as $position) {
            $position->rooms()->attach($rooms->random(rand(1, 3)));
        }

        $users = User::factory()->count(10)->create()->each(function ($user) use ($positions) {
            $user->position_id = $positions->random()->id;
            $user->save();
        });

        function userEntry($user) {
            $allowedRooms = $user->position->rooms->pluck('id')->toArray();
            for ($i = 0; $i < 15; $i++) {
                $randomRoomId = Room::inRandomOrder()->first()->id;
                $isSuccessful = in_array($randomRoomId, $allowedRooms);
    
                UserRoomEntry::create([
                    'user_id' => $user->id,
                    'room_id' => $randomRoomId,
                    'successful' => $isSuccessful,
                ]);
            }
        }

        foreach ($users as $user) {
            if ($user->position) {
                userEntry($user);
            }
        }

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'admin' => true,
            'phone_number' => '123-456-7890',
            'card_number' => strtoupper(fake()->bothify('################')),
            'position_id' => $positions->first()->id,
        ]);

        $nonadmin = User::create([
            'name' => 'nemadmin',
            'email' => 'nemadmin@nemadmin.com',
            'password' => Hash::make('password'),
            'admin' => false,
            'phone_number' => '098-765-4321',
            'card_number' => strtoupper(fake()->bothify('################')),
            'position_id' => $positions->last()->id,
        ]);

        userEntry($admin);
        userEntry($nonadmin);
    }
}
