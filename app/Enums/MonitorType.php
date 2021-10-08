<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Http()
 * @method static static Tcp()
 * @method static static Ping()
 * @method static static Dns()
 */
final class MonitorType extends Enum
{
    const Http = 'http';
    const Tcp = 'tcp';
    const Ping = 'ping';
    const Dns = 'dns';
}
