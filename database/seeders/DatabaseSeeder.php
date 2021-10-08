<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@localhost',
            'password' => Hash::make('password'),
        ]);

        if (app()->environment() !== 'production') {
            $this->call(UserSeeder::class);
            $this->call(MonitorSeeder::class);
        }
    }
}
