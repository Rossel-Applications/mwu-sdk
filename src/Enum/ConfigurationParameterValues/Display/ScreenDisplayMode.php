<?php

declare(strict_types=1);

namespace MwuSdk\Enum\ConfigurationParameterValues\Display;

use MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration of display modes.
 *
 * Defines the available modes for the display:
 *
 * - **ON**: Display is continuously active.
 * - **OFF**: Display is turned off.
 * - **FLASH**: Display flashes intermittently.
 * - **FAST_FLASH**: Display flashes rapidly.
 */
enum ScreenDisplayMode: string
{
    use EnumInstanceSearchTrait;

    /** Display is continuously active. */
    case ON = 'on';

    /** Display is turned off. */
    case OFF = 'off';

    /** Display flashes intermittently. */
    case FLASH = 'flash';

    /** Display flashes rapidly. */
    case FAST_FLASH = 'fast_flash';
}
