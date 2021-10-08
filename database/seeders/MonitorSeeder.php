<?php

namespace Database\Seeders;

use App\Models\Monitor;
use App\Models\User;
use Illuminate\Database\Seeder;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            loop_random(function () use ($user) {
                Monitor::factory()->create([
                    'user_id' => $user->id,
                ]);
            }, 0, 5);
        }
    }
}
