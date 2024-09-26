<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\Initialize;

use MwuSdk\Entity\Command\AbstractCommand;

final readonly class InitializeCommand extends AbstractCommand
{
    public function __construct()
    {
        parent::__construct('Z');
    }
}
