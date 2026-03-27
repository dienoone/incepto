<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum JobArrangement: string
{
    use EnumOptions;

    case ON_SITE = 'on-site';
    case REMOTE  = 'remote';
    case HYBRID  = 'hybrid';
}
