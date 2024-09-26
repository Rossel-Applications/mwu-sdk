<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates the button configuration settings.
 *
 * Ensures that the following keys are provided, all expected to be of type 'array':
 * - `confirm`: Configuration for the confirm button.
 * - `fn`: Configuration for the function button.
 * - `quantity_keys`: Configuration for quantity keys.
 */
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
