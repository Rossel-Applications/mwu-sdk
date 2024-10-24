<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client;

use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;

/**
 * Interface for creating MwuLightModule instances.
 *
 * Defines methods for creating individual light modules and generating collections
 * based on provided configurations.
 */
interface MwuLightModuleFactoryInterface
{
    public function create(
        MwuSwitchInterface $switch,
        int $lightModuleId,
        ?BehaviorConfigInterface $behaviorConfig = null,
    ): MwuLightModuleInterface;

    /**
     * @return array<int, MwuLightModuleInterface>
     */
    public function generateCollection(
        LightModulesGeneratorConfigInterface $config,
        MwuSwitchInterface $switch,
        ?BehaviorConfigInterface $behaviorConfig = null,
    ): array;
}
