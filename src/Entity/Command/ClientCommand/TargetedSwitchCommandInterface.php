<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ClientCommand;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;

/**
 * Interface implemented by commands dedicated to a specific switch.
 */
interface TargetedSwitchCommandInterface extends ClientCommandInterface
{
    public function getSwitch(): MwuSwitchInterface;
}
