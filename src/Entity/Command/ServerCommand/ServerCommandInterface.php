<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ServerCommand;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\CommandInterface;

interface ServerCommandInterface extends CommandInterface
{
    public function getSwitch(): MwuSwitchInterface;
}
