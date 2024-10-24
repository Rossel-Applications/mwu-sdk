<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display;

use Rossel\MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration representing the available colors for the confirmation button on the MWU Light Module.
 *
 * This enum provides a set of predefined color values that can be applied to the confirmation button.
 * Each color can be used in conjunction with a specified light mode to determine its binary representation
 * for display purposes.
 */
enum LightColor: string
{
    use EnumInstanceSearchTrait;

    case WHITE = 'white';
    case RED = 'red';
    case GREEN = 'green';
    case BLUE = 'blue';
    case CYAN = 'cyan';
    case MAGENTA = 'magenta';
    case YELLOW = 'yellow';

    /**
     * Get the binary value for this color based on the specified light mode.
     *
     * This method calculates the binary representation of the RGB color by associating the given light mode
     * with the red, green, and blue components. Each color has a unique combination of light modes for the
     * RGB channels, which results in a distinct binary output.
     *
     * @param LightMode $lightMode the light mode to apply for the color
     *
     * @return int the binary representation of the color and light mode
     */
    public function getBinaryValueWithMode(LightMode $lightMode): int
    {
        return match ($this) {
            self::RED => LightMode::getRGBBinaryValue($lightMode, LightMode::OFF, LightMode::OFF),
            self::GREEN => LightMode::getRGBBinaryValue(LightMode::OFF, $lightMode, LightMode::OFF),
            self::BLUE => LightMode::getRGBBinaryValue(LightMode::OFF, LightMode::OFF, $lightMode),
            self::CYAN => LightMode::getRGBBinaryValue(LightMode::OFF, $lightMode, $lightMode),
            self::MAGENTA => LightMode::getRGBBinaryValue($lightMode, LightMode::OFF, $lightMode),
            self::YELLOW => LightMode::getRGBBinaryValue($lightMode, $lightMode, LightMode::OFF),
            self::WHITE => LightMode::getRGBBinaryValue($lightMode, $lightMode, $lightMode),
        };
    }
}
