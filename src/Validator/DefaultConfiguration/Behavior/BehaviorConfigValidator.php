<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\BehaviorConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

final readonly class BehaviorConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS_AFTER_CONFIRM->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(BehaviorConfigKeysEnum::KEY_DISPLAY_STATUS_AFTER_FN->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(BehaviorConfigKeysEnum::KEY_BUTTONS->value)
            ->allowedTypes('array')
            ->required();

        return $optionsResolver;
    }
}
