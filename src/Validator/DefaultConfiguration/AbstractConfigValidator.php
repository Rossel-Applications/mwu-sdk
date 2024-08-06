<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract readonly class AbstractConfigValidator implements ConfigValidatorInterface
{
    /**
     * @param array<array-key, mixed> $config
     */
    public function validate(mixed $config): bool
    {
        $this->getOptionsResolver()->resolve($config);

        return true;
    }

    abstract public function getOptionsResolver(): OptionsResolver;
}
