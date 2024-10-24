<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client\MwuLightModule;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use Rossel\MwuSdk\Model\DisplayStatusInterface;

/**
 * Interface for creating DisplayStatus instances.
 *
 * Defines a method for constructing DisplayStatus objects based on the provided configuration.
 */
interface DisplayStatusFactoryInterface
{
    public function create(?DisplayConfigInterface $config): DisplayStatusInterface;
}
