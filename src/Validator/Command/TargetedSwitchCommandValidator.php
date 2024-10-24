<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Validator\Command;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\TargetedSwitchCommandInterface;
use Rossel\MwuSdk\Exception\Client\Switch\UnexpectedSwitchException;

/**
 * Validator class for ensuring that targeted switch commands are valid.
 * It checks that the command is directed to the expected switch.
 */
final class TargetedSwitchCommandValidator implements TargetedSwitchCommandValidatorInterface
{
    public function validate(TargetedSwitchCommandInterface $command, MwuSwitchInterface $sendTo): void
    {
        $commandSwitch = $command->getSwitch();

        if (!$sendTo->equals($commandSwitch)) {
            throw new UnexpectedSwitchException($commandSwitch, $sendTo);
        }
    }
}
