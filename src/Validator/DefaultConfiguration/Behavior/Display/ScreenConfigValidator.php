<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Display;

use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\ScreenConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

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