<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum JobType: string
{
    use EnumOptions;

    case FULL_TIME = 'full-time';
    case PART_TIME = 'part-time';
    case CONTRACT = 'contract';
    case TEMPORARY = 'temporary';
    case INTERNSHIP = 'internship';
}
