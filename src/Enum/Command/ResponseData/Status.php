<?php

declare(strict_types=1);

namespace MwuSdk\Enum\Command\ResponseData;

use MwuSdk\Enum\EnumInstanceSearchTrait;

enum Status: string
{
    use EnumInstanceSearchTrait;

    case NORMAL_COMPLETION = '00';
    case ANORMAL = '01';
    case SHORTAGE = '10';
}
