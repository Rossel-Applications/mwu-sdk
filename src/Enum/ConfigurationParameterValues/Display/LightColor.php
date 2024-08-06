<?php

declare(strict_types=1);

namespace MwuSdk\Enum\ConfigurationParameterValues\Display;

use MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration of colors for the confirmation button.
 */
enum LightColor: string
{
    use EnumInstanceSearchTrait;

    case WHITE = 'white';
    case RED = 'red';
    case GREEN = 'green';
    case BLUE = 'blue';
    case YELLOW = 'yellow';
    case VIOLET = 'violet';
    case CYAN = 'cyan';
}
