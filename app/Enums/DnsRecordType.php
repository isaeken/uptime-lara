<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static A()
 * @method static static Aaaa()
 * @method static static Caa()
 * @method static static Cname()
 * @method static static Mx()
 * @method static static Ns()
 * @method static static Ptr()
 * @method static static Soa()
 * @method static static Srv()
 * @method static static Txt()
 */
final class DnsRecordType extends Enum
{
    const A = 'a';
    const Aaaa = 'aaaa';
    const Caa = 'caa';
    const Cname = 'cname';
    const Mx = 'mx';
    const Ns = 'ns';
    const Ptr = 'ptr';
    const Soa = 'soa';
    const Srv = 'srv';
    const Txt = 'txt';
}
