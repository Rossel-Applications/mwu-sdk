<?php

namespace MwuSdk\Entity;

use MwuSdk\Entity\Command\CommandInterface;

interface ClientMessageInterface extends MessageInterface
{
    /**
     * Retrieves the encapsulated Command instance.
     *
     * @return CommandInterface the Command instance
     */
    public function getCommand(): CommandInterface;
}
