<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigInterface;
use MwuSdk\Model\ConfirmButtonInterface;

/**
 * Interface for creating ConfirmButton instances.
 *
 * Defines a method for constructing ConfirmButton objects based on the provided configuration.
 */
interface ConfirmButtonFactoryInterface
{
    public function create(?ConfirmButtonConfigInterface $config): ConfirmButtonInterface;
}
