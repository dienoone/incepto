<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum ApplicationStatus: string
{
    use EnumOptions;

    case PENDING = 'pending';
    case REVIEWED = 'reviewed';
    case INTERVIEW = 'interview';
    case REJECTED = 'rejected';
    case ACCEPTED = 'accepted';
}
