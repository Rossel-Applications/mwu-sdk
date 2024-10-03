<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command;

use MwuSdk\Client\MwuSwitchInterface;

/**
 * Interface implemented by commands dedicated to a specific switch.
 */
interface TargetedSwitchCommandInterface extends CommandInterface
{
    public function getSwitch(): MwuSwitchInterface;
}
