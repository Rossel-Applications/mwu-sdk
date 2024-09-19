<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Configuration;

/** Error thrown if the configuration file is invalid. */
class InvalidConfigurationFileException extends \RuntimeException
{
    public function __construct(string $path, ?\Throwable $previous = null)
    {
        $messageTemplate = 'Configuration file %s is invalid.';
        $message = sprintf($messageTemplate, $path);

        parent::__construct($message, 0, $previous);
    }
}
