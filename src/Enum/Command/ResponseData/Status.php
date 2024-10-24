<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Enum\Command\ResponseData;

use Rossel\MwuSdk\Enum\EnumInstanceSearchTrait;

enum Status: string
{
    use EnumInstanceSearchTrait;

    case NORMAL_COMPLETION = '00';
    case ANORMAL = '01';
    case SHORTAGE = '10';
}
