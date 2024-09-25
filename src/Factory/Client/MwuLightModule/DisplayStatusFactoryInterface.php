<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client\MwuLightModule;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use MwuSdk\Model\DisplayStatusInterface;

/**
 * Interface for creating DisplayStatus instances.
 *
 * Defines a method for constructing DisplayStatus objects based on the provided configuration.
 */
interface DisplayStatusFactoryInterface
{
    public function create(?DisplayConfigInterface $config): DisplayStatusInterface;
}
