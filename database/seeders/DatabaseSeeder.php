<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment() !== 'production') {
            $this->call(UserSeeder::class);
            $this->call(MonitorSeeder::class);
        }
    }
}
