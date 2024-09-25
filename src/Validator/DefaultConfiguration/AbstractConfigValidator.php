<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Base class for configuration validators.
 *
 * This abstract class provides a common method for validating
 * configuration options using Symfony's OptionsResolver.
 * Subclasses must implement the method to define specific
 * configuration options and their validation rules.
 */
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
