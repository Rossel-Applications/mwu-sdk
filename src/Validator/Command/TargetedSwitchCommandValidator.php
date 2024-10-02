<?php

declare(strict_types=1);

namespace MwuSdk\Validator\Command;

use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Entity\Command\TargetedSwitchCommandInterface;
use MwuSdk\Exception\Client\Switch\UnexpectedSwitchException;

class TargetedSwitchCommandValidator implements TargetedSwitchCommandValidatorInterface
{
    public function validate(TargetedSwitchCommandInterface $command, MwuSwitchInterface $sendTo): void
    {
        $commandSwitch = $command->getSwitch();

        if ($sendTo->equals($commandSwitch)) {
            throw new UnexpectedSwitchException($commandSwitch, $sendTo);
        }
    }
}
