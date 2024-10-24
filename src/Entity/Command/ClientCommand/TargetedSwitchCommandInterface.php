<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ClientCommand;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;

/**
 * Interface implemented by commands dedicated to a specific switch.
 */
interface TargetedSwitchCommandInterface extends ClientCommandInterface
{
    public function getSwitch(): MwuSwitchInterface;
}
