<?php

namespace Database\Seeders;

use App\Models\Metric;
use App\Models\Monitor;
use Illuminate\Database\Seeder;

class MetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monitors = Monitor::all();
        foreach ($monitors as $monitor) {
            loop_random(function () use ($monitor) {
                Metric::factory()->create([
                    'monitor_id' => $monitor->id,
                ]);
            }, 0, 25);
        }
    }
}
