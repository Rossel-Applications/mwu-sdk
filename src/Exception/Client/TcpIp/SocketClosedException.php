<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Client\TcpIp;

class SocketClosedException extends \RuntimeException implements TcpIpClientExceptionInterface
{
    private const MESSAGE = 'The socket connection was closed by the server.';

    public function __construct(int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct(self::MESSAGE, $code, $previous);
    }
}
