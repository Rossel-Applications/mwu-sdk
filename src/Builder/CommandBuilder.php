<?php

declare(strict_types=1);

namespace MwuSdk\Builder;

use MwuSdk\Entity\Command;
use MwuSdk\Entity\CommandInterface;

class CommandBuilder
{
    private CommandInterface $command;

    public function __construct()
    {
        $this->command = new Command();
    }

    public function getCommand(): CommandInterface
    {
        return $this->command;
    }
}
