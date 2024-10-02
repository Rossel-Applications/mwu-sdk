<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\MwuLightModuleInterface;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;

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
