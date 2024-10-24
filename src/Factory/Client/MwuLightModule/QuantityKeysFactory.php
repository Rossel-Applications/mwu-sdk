<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client\MwuLightModule;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use Rossel\MwuSdk\Model\QuantityKeys;

/**
 * Factory class for creating QuantityKeys instances.
 *
 * This class is responsible for creating QuantityKeys objects
 * based on the provided configuration.
 */
final class QuantityKeysFactory implements QuantityKeysFactoryInterface
{
    public function create(?QuantityKeysConfigInterface $config): QuantityKeys
    {
        return new QuantityKeys(
            $config?->isEnabled(),
            $config?->getMode(),
        );
    }
}
