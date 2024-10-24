<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Display;

use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\ScreenConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates screen configuration settings.
 *
 * This class checks that the screen configuration has the required
 * keys with the correct types and values:
 * - `text`: A string for the display text.
 * - `mode`: A predefined screen display mode.
 */
final readonly class ScreenConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(ScreenConfigKeysEnum::KEY_TEXT->value)
            ->allowedTypes('string')
            ->required();

        $optionsResolver
            ->define(ScreenConfigKeysEnum::KEY_MODE->value)
            ->allowedValues(...ScreenDisplayMode::values())
            ->required();

        return $optionsResolver;
    }
}
