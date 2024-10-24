<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Message\ServerMessage;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Message\ServerMessage\ServerMessageInterface;

interface ServerMessageFactoryInterface
{
    public function createFromString(MwuSwitchInterface $switch, string $message): ServerMessageInterface;
}
