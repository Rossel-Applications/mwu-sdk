<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates the function button configuration.
 *
 * This class ensures that the configuration includes the required keys:
 * - `text`: A string for the button's display text.
 */
final readonly class FnButtonConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(FnButtonConfigKeysEnum::KEY_TEXT->value)
            ->allowedTypes('string')
            ->required();

        return $optionsResolver;
    }
}
