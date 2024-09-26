<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\Write;

use MwuSdk\Entity\Command\AbstractCommand;

/**
 * Represents a write command for the MWU Light Module.
 *
 * This command contains configuration and data to send to the MWU Light Module, allowing control over display options such as text to display, light color, and button behavior.
 */
final readonly class WriteCommand extends AbstractCommand implements WriteCommandInterface
{
}
