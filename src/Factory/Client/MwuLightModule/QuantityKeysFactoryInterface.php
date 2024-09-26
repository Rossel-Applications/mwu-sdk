<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use MwuSdk\Model\QuantityKeysInterface;

/**
 * Interface for creating QuantityKeys instances.
 *
 * This interface defines the method for creating QuantityKeys objects
 * based on the provided configuration.
 */
interface QuantityKeysFactoryInterface
{
    public function create(?QuantityKeysConfigInterface $config): QuantityKeysInterface;
}
