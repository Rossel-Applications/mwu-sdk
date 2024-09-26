<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\BehaviorConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates behavior configuration for the application.
 *
 * This validator ensures that the behavior configuration options
 * are correctly defined and of the expected types. It requires
 * that certain keys exist and that their values conform to the
 * specified types.
 */
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
