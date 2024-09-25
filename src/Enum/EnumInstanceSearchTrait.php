<?php

declare(strict_types=1);

namespace MwuSdk\Enum;

/**
 * Trait intended to be used by enums to facilitate cases research.
 *
 * This trait provides methods to search for enum instances by their string values
 * and to retrieve all possible values of the enum as a list.
 *
 * @method static array<self> cases() Returns an array of all cases of the enum.
 */
trait EnumInstanceSearchTrait
{
    /**
     * Finds an instance of the enum by its string value.
     *
     * This method searches through all cases of the enum and returns the first
     * matching instance whose value corresponds to the given string.
     *
     * @param string $value the string value to search for
     *
     * @return ?self the matching enum instance, or null if no match is found
     */
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

    /**
     * Retrieves a list of all string values of the enum cases.
     *
     * This method returns an array of string values representing all cases
     * of the enum, allowing for easy access to their values.
     *
     * @return list<string> an array of string values of the enum cases
     */
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
