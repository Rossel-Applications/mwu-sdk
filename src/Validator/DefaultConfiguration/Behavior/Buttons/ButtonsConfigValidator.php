<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

final readonly class ButtonsConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(ButtonsConfigKeysEnum::KEY_CONFIRM->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(ButtonsConfigKeysEnum::KEY_FN->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(ButtonsConfigKeysEnum::KEY_QUANTITY_KEYS->value)
            ->allowedTypes('array')
            ->required();

        return $optionsResolver;
    }
}
