<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Switches;

use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\LightModulesGeneratorConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
