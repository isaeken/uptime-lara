<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Metric extends Model
{
    use HasFactory;

    protected $table = 'metrics';

    protected $fillable = [
        'monitor_id',
        'up',
    ];

    protected $casts = [
        'up' => 'boolean',
    ];

    public function monitor(): HasOne
    {
        return $this->hasOne(Monitor::class);
    }
}
