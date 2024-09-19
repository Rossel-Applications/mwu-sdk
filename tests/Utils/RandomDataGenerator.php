<?php

declare(strict_types=1);

namespace MwuSdkTest\Utils;

use Random\RandomException;

final readonly class RandomDataGenerator
{
    /**
     * @throws RandomException
     */
    public static function ipv4Address(): string
    {
        return implode('.', [
            random_int(1, 255),
            random_int(0, 255),
            random_int(0, 255),
            random_int(1, 255),
        ]);
    }
}
