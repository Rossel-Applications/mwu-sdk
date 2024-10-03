<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Configuration;

/** Error thrown if a specified configuration file is invalid. */
final class InvalidConfigurationFileException extends \RuntimeException implements ConfigurationExceptionInterface
{
    public function __construct(string $path, ?\Throwable $previous = null)
    {
        $messageTemplate = 'Configuration file %s is invalid.';
        $message = sprintf($messageTemplate, $path);

        parent::__construct($message, 0, $previous);
    }
}
