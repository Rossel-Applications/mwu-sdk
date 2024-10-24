<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Client\TcpIp;

/**
 * Exception thrown when a socket cannot be created.
 */
final class CannotCreateSocketException extends \RuntimeException implements TcpIpClientExceptionInterface
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Cannot create socket.', 0, $previous);
    }
}
