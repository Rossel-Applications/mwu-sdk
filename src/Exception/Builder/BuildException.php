<?php

declare(strict_types=1);

namespace MwuSdk\Exception\Builder;

/**
 * Exception thrown when a builder fails to create an object.
 */
class BuildException extends \RuntimeException implements BuilderExceptionInterface
{
    private const MESSAGE = 'Cannot build the object of type %s.';

    /**
     * Constructs a new BuildException.
     *
     * @param string      $objectType      the fully qualified class name (FQCN) of the object that failed to be built
     * @param string|null $missingProperty the name of the missing property, if applicable
     */
    public function __construct(string $objectType, ?string $missingProperty = null, ?\Throwable $previous = null)
    {
        $message = sprintf(self::MESSAGE, $objectType);

        // Optionally include missing property in the message
        if (null !== $missingProperty) {
            $message .= sprintf(' Missing property: %s.', $missingProperty);
        }

        parent::__construct($message, previous: $previous);
    }
}
