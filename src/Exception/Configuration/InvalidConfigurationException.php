<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Configuration;

/** Error thrown if a specified configuration is invalid. */
class InvalidConfigurationException extends \RuntimeException implements ConfigurationExceptionInterface
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Configuration is invalid.', 0, $previous);
    }
}
