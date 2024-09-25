<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\MwuLightModule;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;
use MwuSdk\Factory\Client\MwuLightModule\ConfirmButtonFactoryInterface;
use MwuSdk\Factory\Client\MwuLightModule\DisplayStatusFactoryInterface;
use MwuSdk\Factory\Client\MwuLightModule\FnButtonFactoryInterface;
use MwuSdk\Factory\Client\MwuLightModule\QuantityKeysFactoryInterface;

/**
 * Factory class for creating MwuLightModule instances.
 *
 * This class constructs MwuLightModule objects using various configuration interfaces
 * and generates collections of light modules based on specified generator configurations.
 */
final readonly class MwuLightModuleFactory implements MwuLightModuleFactoryInterface
{
    public function __construct(
        private ConfirmButtonFactoryInterface $confirmButtonFactory,
        private DisplayStatusFactoryInterface $displayStatusFactory,
        private FnButtonFactoryInterface $fnButtonFactory,
        private QuantityKeysFactoryInterface $quantityKeysFactory,
    ) {
    }

    public function create(
        MwuSwitchInterface $switch,
        int $lightModuleId,
        ?DisplayConfigInterface $displayStatusConfig = null,
        ?DisplayConfigInterface $displayStatusAfterConfirmConfig = null,
        ?DisplayConfigInterface $displayStatusAfterFnConfig = null,
        ?ConfirmButtonConfigInterface $confirmButtonConfig = null,
        ?FnButtonConfigInterface $fnButtonConfig = null,
        ?QuantityKeysConfigInterface $quantityKeysConfig = null,
    ): MwuLightModule {
        return new MwuLightModule(
            $switch,
            $lightModuleId,
            $this->displayStatusFactory->create($displayStatusConfig),
            $this->displayStatusFactory->create($displayStatusAfterConfirmConfig),
            $this->displayStatusFactory->create($displayStatusAfterFnConfig),
            $this->confirmButtonFactory->create($confirmButtonConfig),
            $this->fnButtonFactory->create($fnButtonConfig),
            $this->quantityKeysFactory->create($quantityKeysConfig),
        );
    }

    /** @return array<int, MwuLightModule> */
    public function generateCollection(
        LightModulesGeneratorConfigInterface $config,
        MwuSwitchInterface $switch,
        ?DisplayConfigInterface $displayStatusConfig = null,
        ?DisplayConfigInterface $displayStatusAfterConfirmConfig = null,
        ?DisplayConfigInterface $displayStatusAfterFnConfig = null,
        ?ConfirmButtonConfigInterface $confirmButtonConfig = null,
        ?FnButtonConfigInterface $fnButtonConfig = null,
        ?QuantityKeysConfigInterface $quantityKeysConfig = null,
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
                $displayStatusConfig,
                $displayStatusAfterConfirmConfig,
                $displayStatusAfterFnConfig,
                $confirmButtonConfig,
                $fnButtonConfig,
                $quantityKeysConfig,
            );
        }

        return $lightModules;
    }
}
