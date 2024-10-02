<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client\TcpIp;

/**
 * Exception thrown when a connection fails.
 */
final class ConnectionFailedException extends \RuntimeException implements TcpIpClientExceptionInterface
{
    public function __construct(string $serverIp, int $serverPort, int $errorCode, string $errorMessage, ?\Throwable $previous = null)
    {
        $message = sprintf('Could not connect to server: %s:%s. Error %s: %s', $serverIp, $serverPort, $errorCode, $errorMessage);

        parent::__construct($message, 0, $previous);
    }
}
