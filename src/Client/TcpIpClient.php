<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Exception\Client\TcpIp\CannotCreateSocketException;

/**
 * TCP/IP client to send messages to a specified Switch.
 */
final class TcpIpClient implements TcpIpClientInterface
{
    private \Socket $socket;

    public function __construct(
        private readonly string $switchIp,
        private readonly int $switchPort,
        private readonly int $timeout = 5,
    ) {
        $this->createSocket();
    }

    /**
     * {@inheritDoc}
     *
     * @return string|null the response from the Switch, or null if an error occurred
     */
    public function sendMessage(string $message): ?string
    {
        // Send message
        socket_write($this->socket, $message);

        // Get response from server
        $response = socket_read($this->socket, 1024);

        return false !== $response ? $response : null;
    }

    private function createSocket(): void
    {
        ini_set('default_socket_timeout', $this->timeout);

        $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);

        if (false === $socket) {
            throw new CannotCreateSocketException();
        }
        $res = socket_connect($socket, $this->switchIp, $this->switchPort);
        if (false === $res) {
            throw new CannotCreateSocketException();
        }

        $this->socket = $socket;
    }
}
