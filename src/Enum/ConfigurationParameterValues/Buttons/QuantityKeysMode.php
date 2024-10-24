<?php

declare(strict_types=1);

namespace MwuSdk\Enum\ConfigurationParameterValues\Buttons;

use MwuSdk\Enum\EnumInstanceSearchTrait;

/**
 * Enumeration of quantity management modes for the "+" and "-" keys.
 *
 * The available modes are:
 *
 * - **OFF**: The "+" and "-" keys are disabled. No action is performed when these keys are pressed.
 * - **INCREMENT**: The "+" key increments the quantity by 1, and the "-" key decrements the quantity by 1.
 * - **REVISE**: The "S" key moves the cursor to the left. The "-" key decrements the digit at the cursor position by 1.
 */
enum QuantityKeysMode: string
{
    use EnumInstanceSearchTrait;

    private const BINARY_VALUES = [
        self::OFF->name => 'A',
        self::INCREMENT->name => 'B',
        self::REVISE->name => '@',
    ];

    /**
     * Off mode: The "+" and "-" keys are disabled.
     */
    case OFF = 'off';

    /**
     * Increment mode:
     * - The "+" key increments the quantity by 1.
     * - The "-" key decrements the quantity by 1.
     */
    case INCREMENT = 'increment';

    /**
     * Revision mode:
     * - The "S" key moves the cursor to the left.
     * - The "-" key decrements the digit at the cursor position by 1.
     */
    case REVISE = 'revise';

    public static function getBinaryValue(self $quantityKeysMode): string
    {
        return self::BINARY_VALUES[$quantityKeysMode->name];
    }
}
