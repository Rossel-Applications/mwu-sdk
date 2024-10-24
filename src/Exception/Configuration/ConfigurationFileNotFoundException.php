<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Exception\Configuration;

/**
 * Error thrown when a specified configuration file cannot be found.
 */
final class ConfigurationFileNotFoundException extends \RuntimeException implements ConfigurationExceptionInterface
{
    public function __construct(string $path, ?\Throwable $previous = null)
    {
        $message = "Configuration file with path '{$path}' not found.";

        parent::__construct($message, 0, $previous);
    }
}
