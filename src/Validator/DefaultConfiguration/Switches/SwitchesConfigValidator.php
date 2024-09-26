<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Switches;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Validates the configuration for switches settings.
 *
 * This validator ensures that the switches configuration options
 * are correctly defined and of the expected types. It requires
 * that certain keys exist and that their values conform to the
 * specified types.
 */
final readonly class SwitchesConfigValidator implements ConfigValidatorInterface
{
    /**
     * @param array<array-key, mixed> $config
     */
    public function validate(mixed $config): bool
    {
        $switches = $config;

        $result = true;

        foreach ($switches as $switch) {
            if (false === $result) {
                return false;
            }

            $result = \is_array($switch) && $this->getOptionsResolver()->resolve($switch);
        }

        return $result;
    }

    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(SwitchesConfigKeysEnum::ITEM_KEY_IP_ADDRESS->value)
            ->allowedTypes('string')
            ->required();

        $optionsResolver
            ->define(SwitchesConfigKeysEnum::ITEM_KEY_IP_PORT->value)
            ->allowedTypes('numeric')
            ->required();

        $optionsResolver
            ->define(SwitchesConfigKeysEnum::ITEM_KEY_LIGHT_MODULES_GENERATOR->value)
            ->allowedTypes('array')
            ->required();

        return $optionsResolver;
    }
}
