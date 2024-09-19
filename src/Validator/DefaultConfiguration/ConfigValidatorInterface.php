<?php

declare(strict_types=1);

namespace MwuSdk\Validator\DefaultConfiguration;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface ConfigValidatorInterface
{
    public function validate(mixed $config): bool;

    public function getOptionsResolver(): OptionsResolver;
}
