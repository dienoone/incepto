<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum JobStatus: string
{
    use EnumOptions;

    case DRAFT = 'draft';
    case OPEN = 'open';
    case CLOSED = 'closed';
    case EXPIRED = 'expired';
}
