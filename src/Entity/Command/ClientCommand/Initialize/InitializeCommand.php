<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Entity\Command\ClientCommand\Initialize;

use Rossel\MwuSdk\Entity\Command\AbstractCommand;

final readonly class InitializeCommand extends AbstractCommand implements InitializeCommandInterface
{
    private const COMMAND_TEMPLATE = 'Z';

    public function __construct()
    {
        parent::__construct(self::COMMAND_TEMPLATE);
    }
}
