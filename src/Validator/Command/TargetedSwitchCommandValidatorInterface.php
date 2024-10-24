<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Validator\Command;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\TargetedSwitchCommandInterface;

/**
 * Interface for validating targeted switch commands.
 *
 * This interface defines a contract for validators that ensure a command is directed
 * to the correct switch. Implementations of this interface should check the
 * consistency between the command's intended target and the actual switch being addressed.
 */
interface TargetedSwitchCommandValidatorInterface extends CommandValidatorInterface
{
    public function validate(TargetedSwitchCommandInterface $command, MwuSwitchInterface $sendTo): void;
}
