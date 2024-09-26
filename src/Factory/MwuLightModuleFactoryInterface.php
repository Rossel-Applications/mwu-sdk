<?php

declare(strict_types=1);

namespace MwuSdk\Factory;

use MwuSdk\Client\MwuLightModuleInterface;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfigInterface;

interface MwuLightModuleFactoryInterface
{
    public function create(
        MwuSwitchInterface $switch,
        int $lightModuleId,
        ?DisplayConfigInterface $displayStatusConfig = null,
        ?DisplayConfigInterface $displayStatusAfterConfirmConfig = null,
        ?DisplayConfigInterface $displayStatusAfterFnConfig = null,
        ?ConfirmButtonConfigInterface $confirmButtonConfig = null,
        ?FnButtonConfigInterface $fnButtonConfig = null,
        ?QuantityKeysConfigInterface $quantityKeysConfig = null,
    ): MwuLightModuleInterface;

    /**
     * @return list<MwuLightModuleInterface>
     */
    public function generateCollection(
        LightModulesGeneratorConfigInterface $config,
        MwuSwitchInterface $switch,
        ?DisplayConfigInterface $displayStatusConfig = null,
        ?DisplayConfigInterface $displayStatusAfterConfirmConfig = null,
        ?DisplayConfigInterface $displayStatusAfterFnConfig = null,
        ?ConfirmButtonConfigInterface $confirmButtonConfig = null,
        ?FnButtonConfigInterface $fnButtonConfig = null,
        ?QuantityKeysConfigInterface $quantityKeysConfig = null,
    ): array;
}
