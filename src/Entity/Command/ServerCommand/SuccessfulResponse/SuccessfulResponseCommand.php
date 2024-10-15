<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ServerCommand\SuccessfulResponse;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\AbstractCommand;

final readonly class SuccessfulResponseCommand extends AbstractCommand implements SuccessfulResponseCommandInterface
{
    private const COMMAND_TEMPLATE = 'o';

    public function __construct(
        private MwuSwitchInterface $switch,
    ) {
        parent::__construct(self::COMMAND_TEMPLATE);
    }

    public function getSwitch(): MwuSwitchInterface
    {
        return $this->switch;
    }
}
