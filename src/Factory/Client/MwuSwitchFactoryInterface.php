<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitch;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

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
     * @param array<array-key, SwitchConfigInterface> $switchConfigs
     *
     * @return list<MwuSwitch>
     */
    public function createCollection(array $switchConfigs, ?BehaviorConfigInterface $behaviorConfig): array;
}
