<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\MwuClientInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;

/**
 * Interface for Mwu client factory.
 *
 * Defines a method for creating Mwu client instances based on provided configuration.
 */
interface MwuFactoryInterface
{
    public function create(MwuConfigInterface $config): MwuClientInterface;
}
