<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ServerCommand;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\CommandInterface;

interface ServerCommandInterface extends CommandInterface
{
    public function getSwitch(): MwuSwitchInterface;
}
