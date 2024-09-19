<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Display;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\DisplayConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

final readonly class DisplayConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(DisplayConfigKeysEnum::KEY_LIGHT->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(DisplayConfigKeysEnum::KEY_SCREEN->value)
            ->allowedTypes('array')
            ->required();

        return $optionsResolver;
    }
}