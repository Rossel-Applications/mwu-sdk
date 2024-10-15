<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client\TcpIp;

/**
 * Exception thrown when a connection fails.
 */
final class CannotConnectSocketException extends \RuntimeException implements TcpIpClientExceptionInterface
{
    public function __construct(string $serverIp, int $serverPort, ?\Throwable $previous = null)
    {
        $message = sprintf('Could not connect to switch %s:%s.', $serverIp, $serverPort);

        parent::__construct($message, 0, $previous);
    }
}
