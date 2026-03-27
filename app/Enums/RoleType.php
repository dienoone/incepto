<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum RoleType: string
{
    use EnumOptions;

    case ADMIN = 'admin';
    case COMPANY = 'company';
    case SEEKER = 'seeker';
}
