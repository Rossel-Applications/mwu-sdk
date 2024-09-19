<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\MwuLightModule;
use MwuSdk\Client\MwuSwitch;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\MwuConfig;

class MwuLightModuleFactory implements FactoryInterface
{
    public function create(MwuConfig $config): MwuLightModule
    {
        // todo: implement this method
    }

    /** @return list<MwuLightModule> */
    public function createCollectionFromGenerator(LightModulesGeneratorConfigInterface $config, MwuSwitch $switch): array
    {
        $firstLightModuleId = $config->getFirstLightModuleId();
        $increment = $config->getIncrementBetweenLightModuleIds();
        $numberOfModules = $config->getNumberOfLightModules();

        $lightModules = [];

        for ($i = 0; $i < $numberOfModules; ++$i) {
            $lightModuleId = $firstLightModuleId + $i * $increment;
            $lightModules[] = new MwuLightModule($switch, $lightModuleId);
        }

        return $lightModules;
    }
}
