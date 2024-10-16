<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ClientCommand\Initialize;

use MwuSdk\Entity\Command\AbstractCommand;

final readonly class InitializeCommand extends AbstractCommand implements InitializeCommandInterface
{
    private const COMMAND_TEMPLATE = 'Z';

    public function __construct()
    {
        parent::__construct(self::COMMAND_TEMPLATE);
    }
}
