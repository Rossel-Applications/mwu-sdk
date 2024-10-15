<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ClientCommand\Initialize;

use MwuSdk\Entity\Command\AbstractCommand;

final readonly class InitializeCommand extends AbstractCommand implements InitializeCommandInterface
{
    public function __construct()
    {
        parent::__construct('Z');
    }
}
