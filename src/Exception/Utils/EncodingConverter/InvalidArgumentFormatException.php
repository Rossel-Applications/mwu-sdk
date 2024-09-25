<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Utils\EncodingConverter;

/**
 * Exception for invalid argument format.
 */
class InvalidArgumentFormatException extends \RuntimeException
{
    public function __construct(string $parameterName, string $details, ?\Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Invalid parameter format for $%s: %s', $parameterName, $details),
            0,
            $previous,
        );
    }
}
