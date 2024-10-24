<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ClientCommand;

use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;

/**
 * Interface implemented by commands dedicated to a specific light module.
 */
interface TargetedLightModuleCommandInterface extends TargetedSwitchCommandInterface
{
    public function getLightModule(): MwuLightModuleInterface;
}
