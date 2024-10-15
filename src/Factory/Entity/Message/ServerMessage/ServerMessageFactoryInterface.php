<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Message\ServerMessage;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;

interface ServerMessageFactoryInterface
{
    public function createFromString(MwuSwitchInterface $switch, string $message): ServerMessageInterface;
}
