<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Entity\Command\Initialize\InitializeCommand;
use MwuSdk\Entity\Message;
use MwuSdk\Exception\Client\TcpIp\CannotCreateSocketException;
use MwuSdk\Exception\Client\TcpIp\ConnectionFailedException;
use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use Random\RandomException;

/**
 * TCP/IP client to send messages to a specified Switch.
 */
final class TcpIpClient implements TcpIpClientInterface
{
    private string $switchIp;
    private int $switchPort;

    private \Socket $socket;
    private bool $socketConnectionOpen = false;

    public function __construct(
    ) {
        $this->initialize();
    }

    /**
     * {@inheritDoc}
     */
    public function configure(MwuSwitchInterface $switch, int $timeout = 10): void
    {
        if ($this->isSocketConnectionOpen()) {
            $this->closeSocketConnection();
        }

        $switchConfig = $switch->getConfig();

        $this->switchIp = $switchConfig->getIpAddress();
        $this->switchPort = $switchConfig->getPort();

        ini_set('default_socket_timeout', $timeout);

        $this->initialize();
    }

    /**
     * {@inheritDoc}
     *
     * @return string|null the response from the Switch, or null if an error occurred
     */
    public function sendMessage(string $message): ?string
    {
        if (!$this->isSocketConnectionOpen()) {
            $this->openSocketConnection();
        }

        // Send message
        socket_write($this->socket, $message);

        // Get response from server
        $response = socket_read($this->socket, 1024);

        return false !== $response ? $response : null;
    }

    /**
     * {@inheritDoc}
     */
    public function openSocketConnection(): void
    {
        try {
            socket_connect($this->socket, $this->switchIp, $this->switchPort);
            $this->socketConnectionOpen = true;

            $this->sendMessage((string) new Message(new InitializeCommand()));
        } catch (TcpIpClientExceptionInterface|RandomException $exception) {
            throw new ConnectionFailedException($this->switchIp, $this->switchPort, $exception->getCode(), $exception->getMessage(), $exception);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function closeSocketConnection(): void
    {
        socket_close($this->socket);
        $this->socketConnectionOpen = false;
    }

    /**
     * {@inheritDoc}
     */
    public function isSocketConnectionOpen(): bool
    {
        return $this->socketConnectionOpen;
    }

    private function initialize(): void
    {
        $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);

        if (false === $socket) {
            throw new CannotCreateSocketException();
        }

        $this->socket = $socket;
    }
}
