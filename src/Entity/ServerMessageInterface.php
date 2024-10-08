<?php

namespace MwuSdk\Entity;

interface ServerMessageInterface extends MessageInterface
{
    /**
     * Retrieves the data encapsulated inside the Server Message.
     */
    public function getData(): string;
}
