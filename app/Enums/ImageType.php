<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum ImageType: string
{
    use EnumOptions;

    case AVATAR    = 'avatars';
    case LOGO      = 'logos';
    case COVER     = 'covers';
    case IMAGE     = 'images';
}
