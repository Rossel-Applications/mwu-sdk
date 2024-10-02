<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client\TcpIp;

final class CannotCreateSocketException extends \RuntimeException implements TcpIpClientExceptionInterface
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Cannot create socket.', 0, $previous);
    }
}
