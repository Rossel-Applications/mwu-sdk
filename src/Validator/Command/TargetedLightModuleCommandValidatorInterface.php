<?php

declare(strict_types=1);

namespace MwuSdk\Validator\Command;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\ClientCommand\TargetedLightModuleCommandInterface;

/**
 * Interface for validators that ensure targeted light module commands are valid.
 */
interface TargetedLightModuleCommandValidatorInterface extends CommandValidatorInterface
{
    /**
     * Validates that the command targets a reachable light module.
     *
     * @param TargetedLightModuleCommandInterface $command The command to be validated
     * @param MwuSwitchInterface                  $sendTo  The switch to which the command is sent
     */
    public function validate(TargetedLightModuleCommandInterface $command, MwuSwitchInterface $sendTo): void;
}
