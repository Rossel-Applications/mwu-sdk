<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration\Behavior\Display;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Validator\DefaultConfiguration\ConfigValidatorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class LightConfigValidator implements ConfigValidatorInterface
{
    private const KEY_MODE = 'mode';
    private const KEY_COLOR = 'color';

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
        $optionsResolver = new OptionsResolver();

        $optionsResolver
            ->define(self::KEY_MODE)
            ->allowedValues(...LightMode::values())
            ->required();

        $optionsResolver
            ->define(self::KEY_COLOR)
            ->allowedValues(...LightColor::values())
            ->required();

        return $optionsResolver;
    }
}
