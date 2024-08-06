<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\ConfigKeysEnum;
use Symfony\Component\OptionsResolver\OptionsResolver;

final readonly class ConfigValidator implements ConfigValidatorInterface
{
    public function validate(mixed $config): bool
    {
        if (false === \is_array($config)) {
            return false;
        }

        $this->getOptionsResolver()->resolve($config);

        return true;
    }

    public function getOptionsResolver(): OptionsResolver
    {
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(ConfigKeysEnum::KEY_SWITCHES->value)
            ->allowedTypes('array')
            ->required();

        $optionsResolver
            ->define(ConfigKeysEnum::KEY_BEHAVIOR->value)
            ->allowedTypes('array')
            ->required();

        return $optionsResolver;
    }
}
