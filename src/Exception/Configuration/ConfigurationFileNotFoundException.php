<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Configuration;

class ConfigurationFileNotFoundException extends \RuntimeException
{
    public function __construct(string $path, ?\Throwable $previous = null)
    {
        $message = "Configuration file with path '{$path}' not found.";

        parent::__construct($message, 0, $previous);
    }
}
