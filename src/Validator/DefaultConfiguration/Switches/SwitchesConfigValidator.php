<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Switches;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
