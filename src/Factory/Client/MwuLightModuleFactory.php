<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\MwuLightModule\MwuLightModule;
use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;

/**
 * Factory class for creating MwuLightModule instances.
 *
 * This class constructs MwuLightModule objects using various configuration interfaces
 * and generates collections of light modules based on specified generator configurations.
 */
final readonly class MwuLightModuleFactory implements MwuLightModuleFactoryInterface
{
    public function __construct()
    {
    }

    public function create(
        MwuSwitchInterface $switch,
        int $lightModuleId,
        ?BehaviorConfigInterface $behaviorConfig = null,
    ): MwuLightModule {
        return new MwuLightModule(
            $switch,
            $lightModuleId,
            $behaviorConfig,
        );
    }

    /** @return array<int, MwuLightModule> */
    public function generateCollection(
        LightModulesGeneratorConfigInterface $config,
        MwuSwitchInterface $switch,
        ?BehaviorConfigInterface $behaviorConfig = null,
    ): array {
        $firstLightModuleId = $config->getFirstLightModuleId();
        $increment = $config->getIncrementBetweenLightModuleIds();
        $numberOfModules = $config->getNumberOfLightModules();

        $lightModules = [];

        for ($i = 0; $i < $numberOfModules; ++$i) {
            $lightModuleId = $firstLightModuleId + $i * $increment;
            $lightModules[$lightModuleId] = $this->create(
                $switch,
                $lightModuleId,
                $behaviorConfig,
            );
        }

        return $lightModules;
    }
}
