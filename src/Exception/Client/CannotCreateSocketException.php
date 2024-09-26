<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Client;

class CannotCreateSocketException extends \RuntimeException implements ConnectionExceptionInterface
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Cannot create socket.', 0, $previous);
    }
}
