<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface for configuration validators.
 *
 * This interface defines methods for validating configuration
 * data and providing an OptionsResolver for defining expected options.
 */
interface ConfigValidatorInterface
{
    /**
     * Validates the given configuration data.
     *
     * @param mixed $config the configuration data to validate
     *
     * @return bool true if the configuration is valid, false otherwise
     */
    public function validate(mixed $config): bool;

    /**
     * Gets the OptionsResolver for defining expected options.
     *
     * @return OptionsResolver the OptionsResolver instance
     */
    public function getOptionsResolver(): OptionsResolver;
}
