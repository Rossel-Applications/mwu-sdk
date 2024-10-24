<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client\MwuLightModule;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use Rossel\MwuSdk\Model\QuantityKeysInterface;

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
