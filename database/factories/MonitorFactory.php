<?php

namespace Database\Factories;

use App\Enums\DnsRecordType;
use App\Enums\MonitorType;
use App\Models\Monitor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use stdClass;

class MonitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Monitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->text(20),
            'monitor_type' => ($type = MonitorType::getRandomValue()),
            'monitor_data' => $this->makeRandomDataFromType($type),
            'heartbeat_interval' => rand(60, 120),
            'retry_interval' => rand(60, 120),
            'upside_down' => $this->faker->boolean(5),
        ];
    }

    public function makeRandomDataFromType(string $type): object
    {
        $data = new stdClass;

        if ($type == MonitorType::Http()) {
            $data->url = $this->faker->url;
        } elseif ($type == MonitorType::Tcp()) {
            $data->hostname = $this->faker->ipv4;
            $data->port = rand(1, 10000);
        } elseif ($type == MonitorType::Ping()) {
            $data->hostname = $this->faker->ipv4;
        } elseif ($type == MonitorType::Dns()) {
            $data->hostname = $this->faker->ipv4;
            $data->resolver_server = $this->faker->ipv4;
            $data->dns_record_type = DnsRecordType::getRandomValue();
        }

        return $data;
    }
}
