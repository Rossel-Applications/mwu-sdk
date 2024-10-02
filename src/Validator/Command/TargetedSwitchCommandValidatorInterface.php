<?php

declare(strict_types=1);

namespace MwuSdk\Validator\Command;

use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Entity\Command\TargetedSwitchCommandInterface;

interface TargetedSwitchCommandValidatorInterface extends CommandValidatorInterface
{
    public function validate(TargetedSwitchCommandInterface $command, MwuSwitchInterface $sendTo): void;
}
