<?php

declare(strict_types=1);

namespace MwuSdk\Enum\ConfigurationParameterValues\Display;

use MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration of light modes for the confirmation button.
 *
 * This enumeration defines the different states in which the light on the confirmation button can be set.
 */
enum LightMode: string
{
    use EnumInstanceSearchTrait;

    /**
     * The light on the confirmation button is continuously illuminated.
     */
    case ON = 'on';

    /**
     * The light on the confirmation button is turned off.
     */
    case OFF = 'off';

    /**
     * The light on the confirmation button flashes at a standard rate.
     */
    case FLASH = 'flash';

    /**
     * The light on the confirmation button flashes at a rapid rate.
     */
    case FAST_FLASH = 'fast_flash';
}
