<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons;

use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\QuantityKeysConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\AbstractConfigValidator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates the quantity keys configuration.
 *
 * This class ensures that the configuration includes the required key:
 * - `mode`: Must be one of the predefined values from the QuantityKeysMode enum.
 */
final readonly class QuantityKeysConfigValidator extends AbstractConfigValidator
{
    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(QuantityKeysConfigKeysEnum::KEY_MODE->value)
            ->allowedValues(...QuantityKeysMode::values())
            ->required();

        return $optionsResolver;
    }
}
