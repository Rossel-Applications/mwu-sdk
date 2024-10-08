<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;

/**
 * Interface for TCP/IP communication with a Switch.
 */
interface TcpIpClientInterface
{
    /**
     * Sends a message to the Switch.
     *
     * @param string $message the message to send
     *
     * @throws TcpIpClientExceptionInterface if the connection fails
     *
     * @return string|null the response from the Switch, or null if an error occurred
     */
    public function sendMessage(string $message): ?string;
}
