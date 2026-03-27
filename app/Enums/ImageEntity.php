<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum ImageEntity: string
{
    use EnumOptions;

    case SEEKER     = 'seekers';
    case COMPANY    = 'companies';
    case ADMIN      = 'admins';
}
