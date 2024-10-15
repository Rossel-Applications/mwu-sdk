<?php

namespace MwuSdk\Factory\Entity;

use MwuSdk\Entity\ServerMessage;

class ServerMessageFactory implements ServerMessageFactoryInterface
{
    public function createFromString(string $message): ServerMessage
    {
        $sequenceNumber = substr($message, 1, 3);

    }
}
