<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Exception\Client\CannotCreateSocketException;
use MwuSdk\Exception\Client\ConnectionFailedException;

/**
 * TCP/IP client to send messages to a server.
 */
final class TcpIpClient
{
    private \Socket $socket;
    private bool $connected = false;

    public function __construct(
        private readonly string $serverIp,
        private readonly int $serverPort,
        private readonly int $timeout = 10,
    ) {
        $this->initialize();
    }

    /**
     * Send a message to the server.
     *
     * @throws \Exception if the connection fails
     *
     * @return string|null the response from the server, or null if an error occurred
     */
    public function sendMessage(string $message): ?string
    {
        if (!$this->isConnected()) {
            $this->openConnection();
        }

        // Send message
        socket_write($this->socket, $message);

        // Get response from server
        return socket_read($this->socket, 1024);
    }

    public function isConnected(): bool
    {
        return $this->connected;
    }

    private function openConnection(): void
    {
        try {
            socket_connect($this->socket, $this->serverIp, $this->serverPort);
        } catch (\Exception $exception) {
            throw new ConnectionFailedException($this->serverIp, $this->serverPort, $exception->getCode(), $exception->getMessage(), $exception->getCode());
        }
    }

    private function initialize(): void
    {
        $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);

        if (false === $socket) {
            throw new CannotCreateSocketException();
        }

        $this->socket = $socket;

        ini_set('default_socket_timeout', $this->timeout);
    }
}
