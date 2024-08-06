<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Configuration;

/** Error thrown if the configuration file is invalid. */
class InvalidConfigurationException extends \RuntimeException
{
    public function __construct(?\Throwable $previous = null)
    {
        parent::__construct('Configuration is invalid.', 0, $previous);
    }
}
