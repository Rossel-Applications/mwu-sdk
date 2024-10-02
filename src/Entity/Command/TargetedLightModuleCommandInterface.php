<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command;

use MwuSdk\Client\MwuLightModuleInterface;

interface TargetedLightModuleCommandInterface extends TargetedSwitchCommandInterface
{
    public function getLightModule(): MwuLightModuleInterface;
}
