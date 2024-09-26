<?php

declare(strict_types=1);

namespace MwuSdk\Enum\ConfigurationParameterValues\Display;

use MwuSdk\Enum\BinaryEncodableInterface;
use MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration representing the display modes for the MWU Light Module.
 *
 * This enumeration defines the various modes available for controlling the display's behavior.
 * Each mode determines how the display will respond visually:
 *
 * - **ON**: The display remains continuously active, showing information.
 * - **OFF**: The display is turned off, and no information is displayed.
 * - **FLASH**: The display flashes intermittently, e.g., to draw attention or indicate a status.
 * - **FAST_FLASH**: The display flashes rapidly, providing a more urgent visual signal.
 */
enum ScreenDisplayMode: string implements BinaryEncodableInterface
{
    use EnumInstanceSearchTrait;

    /**
     * Nibbles (4-bit packets) representing the binary values associated with each display mode.
     */
    private const BINARY_VALUES = [
        self::OFF->name => 0b0001,
        self::ON->name => 0b0010,
        self::FLASH->name => 0b0011,
        self::FAST_FLASH->name => 0b0100,
    ];

    /** The display is continuously active. */
    case ON = 'on';

    /** The display is turned off. */
    case OFF = 'off';

    /** The display flashes intermittently. */
    case FLASH = 'flash';

    /** The display flashes rapidly. */
    case FAST_FLASH = 'fast_flash';

    /**
     * Get the 4-bit binary representation of this display mode.
     *
     * This method retrieves the corresponding binary value for the display mode,
     * allowing it to be encoded for communication with the MWU Light Module.
     *
     * @return int the 4-bit binary representation of the display mode
     */
    public function getBinaryValue(): int
    {
        return self::BINARY_VALUES[$this->name];
    }
}
