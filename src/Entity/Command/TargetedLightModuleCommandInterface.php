<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command;

use MwuSdk\Client\MwuLightModuleInterface;

/**
 * Interface implemented by commands dedicated to a specific light module.
 */
interface TargetedLightModuleCommandInterface extends TargetedSwitchCommandInterface
{
    public function getLightModule(): MwuLightModuleInterface;
}
