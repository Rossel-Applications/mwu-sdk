<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use MwuSdk\Model\FnButtonInterface;

/**
 * Interface for creating FnButton instances.
 *
 * This interface defines the method for creating FnButton objects
 * based on the provided configuration.
 */
interface FnButtonFactoryInterface
{
    public function create(?FnButtonConfigInterface $config): FnButtonInterface;
}