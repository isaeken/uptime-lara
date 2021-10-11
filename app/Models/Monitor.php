<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Monitor extends Model
{
    use HasFactory;

    protected $table = 'monitors';

    protected $fillable = [
        'user_id',
        'name',
        'monitor_type',
        'monitor_data',
        'heartbeat_interval',
        'retry_interval',
        'upside_down',
    ];

    protected $casts = [
        'monitor_data' => AsCollection::class,
        'heartbeat_interval' => 'integer',
        'retry_interval' => 'integer',
        'upside_down' => 'boolean',
    ];

    protected $appends = [
        'last_metrics',
        'address',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function metrics(): HasMany
    {
        return $this->hasMany(Metric::class);
    }

    public function getLastMetricsAttribute(int|null $limit = null): Collection
    {
        $limit = $limit ?? 25;
        $metrics = $this->metrics()->orderByDesc('id')->limit($limit)->get();

        if ($metrics->count() < $limit) {
            $x = $limit - $metrics->count();
            for ($i = 0; $i < $x; $i++) {
                $metrics->prepend(null);
            }
        }

        return $metrics;
    }

    public function getAddressAttribute(): string
    {
        $types = ['ip', 'hostname', 'url'];
        foreach ($types as $type) {
            if ($this->monitor_data?->has($type)) {
                return $this->monitor_data->get($type);
            }
        }

        return 'unknown';
    }
}
