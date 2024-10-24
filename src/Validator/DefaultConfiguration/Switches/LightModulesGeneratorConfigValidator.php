<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Validator\DefaultConfiguration\Switches;

use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\LightModulesGeneratorConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\ConfigValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates the configuration for light modules generator settings.
 *
 * This validator ensures that the light modules generator configuration options
 * are correctly defined and of the expected types. It requires certain keys to exist
 * and validates their values against the specified types.
 */
final class LightModulesGeneratorConfigValidator implements ConfigValidatorInterface
{
    /**
     * @param array<array-key, mixed> $config
     */
    public function validate(mixed $config): bool
    {
        $this->getOptionsResolver()->resolve($config);

        return true;
    }

    public function getOptionsResolver(): OptionsResolver
    {
        $optionResolver = new OptionsResolver();

        $optionResolver
            ->define(LightModulesGeneratorConfigKeysEnum::KEY_FIRST_MODULE_ID->value)
            ->allowedTypes('int')
            ->required();

        $optionResolver
            ->define(LightModulesGeneratorConfigKeysEnum::KEY_INCREMENT_BETWEEN_MODULE_IDS->value)
            ->allowedTypes('int');

        $optionResolver
            ->define(LightModulesGeneratorConfigKeysEnum::KEY_NUMBER_OF_MODULES->value)
            ->allowedTypes('int')
            ->required();

        return $optionResolver;
    }
}
