<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum DetailType: string
{
    use EnumOptions;

    case REQUIREMENT = 'requirement';
    case RESPONSIBILITY = 'responsibility';
    case BENEFIT = 'benefit';
    case MISSION = 'mission';
}
