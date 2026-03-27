<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum AttachmentType: string
{
    use EnumOptions;

    case CV           = 'cv';
    case RESUME       = 'resume';
    case PORTFOLIO    = 'portfolio';
    case CERTIFICATION = 'certification';
    case COVER_LETTER = 'cover-letter';
}
