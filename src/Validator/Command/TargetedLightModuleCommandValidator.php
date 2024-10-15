<?php

declare(strict_types=1);

namespace MwuSdk\Validator\Command;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\ClientCommand\TargetedLightModuleCommandInterface;
use MwuSdk\Exception\Client\LightModule\UnreachableLightModuleException;
use MwuSdk\Exception\Client\Switch\UnexpectedSwitchException;

/**
 * Validator class for ensuring the validity of targeted light module commands.
 * It checks that the light module is attached to the correct switch and has a valid ID.
 */
final readonly class TargetedLightModuleCommandValidator implements TargetedLightModuleCommandValidatorInterface
{
    public function __construct(
        private TargetedSwitchCommandValidatorInterface $targetedSwitchCommandValidator,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * Ensures that the light module is attached to the correct switch and that it has a valid ID.
     *
     * @throws UnreachableLightModuleException if the light module cannot be reached
     */
    public function validate(TargetedLightModuleCommandInterface $command, MwuSwitchInterface $sendTo): void
    {
        $lightModule = $command->getLightModule();
        $lightModule->checkIfReachable(true);

        $commandSwitch = $command->getSwitch();
        $lightModuleSwitch = $lightModule->getSwitch();

        // Ensure the light module is attached to the correct switch
        if (!$commandSwitch->equals($lightModuleSwitch)) {
            throw new UnexpectedSwitchException($sendTo, $commandSwitch);
        }

        $this->targetedSwitchCommandValidator->validate($command, $sendTo);
    }
}
