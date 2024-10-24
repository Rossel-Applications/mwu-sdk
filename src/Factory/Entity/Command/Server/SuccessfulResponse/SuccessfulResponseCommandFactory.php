<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Command\Server\SuccessfulResponse;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ServerCommand\SuccessfulResponse\SuccessfulResponseCommand;

final class SuccessfulResponseCommandFactory implements SuccessfulResponseCommandFactoryInterface
{
    public function supports(string $commandString): bool
    {
        return 1 === \strlen($commandString) && 'o' === $commandString[0];
    }

    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): SuccessfulResponseCommand {
        if (false === $this->supports($commandString)) {
            throw new \InvalidArgumentException("Command string '{$commandString}' is not supported.");
        }

        return new SuccessfulResponseCommand($switch);
    }
}
