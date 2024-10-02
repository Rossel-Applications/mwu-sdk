<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command;

use MwuSdk\Client\MwuSwitchInterface;

interface TargetedSwitchCommandInterface extends CommandInterface
{
    public function getSwitch(): MwuSwitchInterface;
}
