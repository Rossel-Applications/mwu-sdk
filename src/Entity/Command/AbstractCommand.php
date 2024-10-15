<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command;

/**
 * Abstract base class for command objects, providing common utilities for command handling.
 */
readonly class AbstractCommand implements CommandInterface
{
    /**
     * Initializes the command with a given template.
     *
     * @param string $commandTemplate the template string for the command
     */
    public function __construct(
        private string $commandTemplate,
    ) {
    }

    /**
     * Get the length of the command template.
     *
     * @return int the length of the command template string
     */
    public function length(): int
    {
        return \strlen($this->commandTemplate);
    }

    /**
     * Convert the command to its string representation.
     *
     * @return string the command as a string
     */
    public function __toString(): string
    {
        return $this->commandTemplate;
    }

    protected function getCommandTemplate(): string
    {
        return $this->commandTemplate;
    }
}
