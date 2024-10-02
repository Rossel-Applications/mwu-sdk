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
     * Configures the TCP/IP client for the provided Switch.
     */
    public function configure(MwuSwitchInterface $switch, int $timeout = 10): void;

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

    /** Opens a socket connection. */
    public function openSocketConnection(): void;

    /** Closes the socket connection. */
    public function closeSocketConnection(): void;

    /** Checks if the socket connection is open.
     *
     * @return bool true if the connection is open, false otherwise
     */
    public function isSocketConnectionOpen(): bool;
}
