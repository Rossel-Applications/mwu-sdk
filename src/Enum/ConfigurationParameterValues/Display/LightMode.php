<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display;

use Rossel\MwuSdk\Enum\BinaryEncodableInterface;
use Rossel\MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration representing the light modes for the confirmation button on the MWU Light Module.
 *
 * Each mode controls the behavior of the button's light, such as whether it is on, off, or flashing.
 * These modes are used to encode the light status into binary values that can be sent to the module.
 */
enum LightMode: string implements BinaryEncodableInterface
{
    use EnumInstanceSearchTrait;

    /**
     * Nibbles (4-bit packets) representing the binary values associated with each light mode.
     */
    private const BINARY_VALUES = [
        self::OFF->name => 0b0001,
        self::ON->name => 0b0010,
        self::FLASH->name => 0b0011,
        self::FAST_FLASH->name => 0b0100,
    ];

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

    /**
     * Get the binary value of this light mode as a 4-bit integer.
     *
     * The value returned represents the binary encoding of the light mode for communication
     * with the MWU Light Module.
     *
     * @return int the 4-bit binary representation of the light mode
     */
    public function getBinaryValue(): int
    {
        return self::BINARY_VALUES[$this->name];
    }

    /**
     * Get a 12-bit binary word representing the RGB light modes.
     *
     * This method combines the binary values of the red, green, and blue light modes into a single
     * 12-bit word, where each mode is represented by 4 bits. The 12-bit word is used to encode
     * the light settings for all three colors in one message.
     *
     * @param self $red   the light mode for the red LED
     * @param self $green the light mode for the green LED
     * @param self $blue  the light mode for the blue LED
     *
     * @return int the 12-bit binary word representing the RGB light modes
     */
    public static function getRGBBinaryValue(self $red, self $green, self $blue): int
    {
        $redBinaryValue = $red->getBinaryValue();
        $greenBinaryValue = $green->getBinaryValue();
        $blueBinaryValue = $blue->getBinaryValue();

        // Concatenation of the 4-bit values for red, green, and blue into a 12-bit binary word
        return ($redBinaryValue << 8) | ($greenBinaryValue << 4) | $blueBinaryValue;
    }
}
