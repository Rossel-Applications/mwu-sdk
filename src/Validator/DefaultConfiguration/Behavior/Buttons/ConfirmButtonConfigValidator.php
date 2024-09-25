<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ConfirmButtonConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates the confirm button configuration.
 *
 * Ensures that the configuration includes the required key:
 * - `enabled`: A boolean indicating if the confirm button is active.
 */
final readonly class ConfirmButtonConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(ConfirmButtonConfigKeysEnum::KEY_ENABLED->value)
            ->allowedTypes('bool')
            ->required();

        return $optionsResolver;
    }
}
