<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\MwuSwitch;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

/**
 * Interface for creating MwuSwitch instances.
 *
 * Defines methods for creating individual MwuSwitch objects and collections
 * based on provided configurations.
 */
interface MwuSwitchFactoryInterface
{
    public function create(SwitchConfigInterface $config, BehaviorConfigInterface $behaviorConfig): MwuSwitchInterface;

    /**
     * @param array<array-key, SwitchConfigInterface> $configs
     *
     * @return array<array-key, MwuSwitch>
     */
    public function createCollection(array $configs): array;
}
