<?php

namespace MwuSdk\Factory\Entity;

use MwuSdk\Entity\ServerMessage;
use MwuSdk\Entity\ServerMessageInterface;

interface ServerMessageFactoryInterface
{
    public function createFromString(string $message): ServerMessageInterface;
}
