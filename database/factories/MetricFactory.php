<?php

namespace Database\Factories;

use App\Models\Metric;
use App\Models\Monitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetricFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Metric::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'monitor_id' => Monitor::factory(),
            'up' => $this->faker->boolean(75),
        ];
    }
}
