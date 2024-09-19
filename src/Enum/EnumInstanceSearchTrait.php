<?php

declare(strict_types=1);

namespace MwuSdk\Enum;

/**
 * @method static array<self> cases()
 */
trait EnumInstanceSearchTrait
{
    public static function findInstanceByStringValue(string $value): ?self
    {
        /** @var self[] $cases */
        $cases = static::cases();

        $matchingInstances = array_filter(
            $cases,
            static function ($case) use ($value) {
                /* @phpstan-ignore class.notFound */
                return $value === $case->value;
            }
        );

        $uniqueResult = reset($matchingInstances);

        return false !== $uniqueResult ? $uniqueResult : null;
    }

    /** @return list<string> */
    public static function values(): array
    {
        return array_map(
            static function ($case) {
                /* @phpstan-ignore class.notFound */
                return $case->value;
            },
            static::cases(),
        );
    }
}
