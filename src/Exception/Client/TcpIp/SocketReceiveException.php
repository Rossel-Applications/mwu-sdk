<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client\TcpIp;

class SocketReceiveException extends \RuntimeException implements TcpIpClientExceptionInterface
{
    public function __construct(?string $details, ?\Throwable $previous = null)
    {
        $message = sprintf(
            'Failed to receive data from the socket%s',
            null !== $details ? ": $details" : '.',
        );

        parent::__construct($message, 0, $previous);
    }
}
