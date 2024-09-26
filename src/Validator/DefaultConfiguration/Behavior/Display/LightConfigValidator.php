<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Display;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates light configuration settings.
 *
 * This class checks that the light configuration has the required
 * keys with the correct types and values:
 * - `mode`: Must be one of the predefined light modes.
 * - `color`: Must be one of the predefined light colors.
 */
final class LightConfigValidator implements ConfigValidatorInterface
{
    private const KEY_MODE = 'mode';
    private const KEY_COLOR = 'color';

    /**
     * Validates the given light configuration.
     *
     * @param array<array-key, mixed> $config the configuration to validate
     *
     * @return bool true if the configuration is valid, false otherwise
     */
    public function validate(mixed $config): bool
    {
        $this->getOptionsResolver()->resolve($config);

        return true;
    }

    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(self::KEY_MODE)
            ->allowedValues(...LightMode::values())
            ->required();

        $optionsResolver
            ->define(self::KEY_COLOR)
            ->allowedValues(...LightColor::values())
            ->required();

        return $optionsResolver;
    }
}
