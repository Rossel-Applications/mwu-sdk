<?php

declare(strict_types=1);

namespace MwuSdk\Client\TcpIp;

use MwuSdk\Exception\Client\TcpIp\CannotConnectSocketException;
use MwuSdk\Exception\Client\TcpIp\CannotCreateSocketException;
use MwuSdk\Exception\Client\TcpIp\SocketClosedException;
use MwuSdk\Exception\Client\TcpIp\SocketReceiveException;

/**
 * TCP/IP client to send messages to a specified Switch.
 */
final class TcpIpClient implements TcpIpClientInterface
{
    private const DEFAULT_TIMEOUT = 5;

    public function __construct(
        private readonly string $ipAddress,
        private readonly int $port,
        private readonly int $timeout = self::DEFAULT_TIMEOUT,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @return string|null the response from the Switch, or null if an error occurred
     */
    public function sendMessage(string $message): ?string
    {
        $socket = self::createSocket($this->ipAddress, $this->port, $this->timeout);

        $bytesSent = socket_write($socket, $message);

        if (false === $bytesSent) {
            throw new \RuntimeException(socket_strerror(socket_last_error($socket)));
        }

        $response = socket_read($socket, 1024);

        if (false === $response) {
            throw new \RuntimeException(socket_strerror(socket_last_error($socket)));
        }

        socket_close($socket);

        return $response ?: null;
    }

    public static function createSocket(string $ipAddress, int $port, int $timeout = self::DEFAULT_TIMEOUT): \Socket
    {
        ini_set('default_socket_timeout', $timeout);

        $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);
        // socket_set_nonblock($socket); // todo: hardware seems misconfigured

        if (false === $socket) {
            throw new CannotCreateSocketException();
        }

        $connected = socket_connect(
            $socket,
            $ipAddress,
            $port,
        );

        if (false === $connected) {
            throw new CannotConnectSocketException($ipAddress, $port);
        }

        return $socket;
    }

    public static function receiveMessageFromSocket(\Socket $socket): string
    {
        $receivedMessage = false;
        socket_recv($socket, $receivedMessage, 1024, 0);

        if (false === $receivedMessage) {
            throw new SocketReceiveException(socket_strerror(socket_last_error($socket)));
        }
        if (0 === $receivedMessage) {
            throw new SocketClosedException();
        }

        return $receivedMessage;
    }

    public static function sendMessageToSocket(\Socket $socket, string $message): void
    {
        socket_write($socket, $message);
    }
}
