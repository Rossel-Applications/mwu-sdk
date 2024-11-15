<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client;

use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModule;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;

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
        $firstLightModuleId = $config->getFirstModuleId();
        $increment = $config->getIncrementBetweenModuleIds();
        $numberOfModules = $config->getNumberOfModules();

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
