<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Command\Server\ResponseData;

use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Entity\Command\ServerCommand\ResponseData\ResponseDataCommand;
use MwuSdk\Entity\Command\ServerCommand\ResponseData\ResponseDataCommandInterface;
use MwuSdk\Enum\Command\ResponseData\Status;
use MwuSdk\Exception\Client\Mwu\SwitchNotFoundException;

final class ResponseDataCommandFactory implements ResponseDataCommandFactoryInterface
{
    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): ResponseDataCommandInterface {
        if (false === $this->supports($commandString)) {
            throw new \InvalidArgumentException("Command string '{$commandString}' is not supported.");
        }

        $lightModuleAddress = substr($commandString, 1, 4);

        if (false === is_numeric($lightModuleAddress)) {
            throw new \InvalidArgumentException("Command string '{$commandString}' does not contain the light module address.");
        }

        $lightModuleAddressInt = (int) $lightModuleAddress;

        $lightModule = $switch->getLightModuleById($lightModuleAddressInt);

        if (null === $lightModule) {
            throw new SwitchNotFoundException($lightModuleAddressInt);
        }

        $status = Status::findInstanceByStringValue(substr($commandString, 5, 2));

        if (null === $status) {
            throw new \InvalidArgumentException("Command string '{$commandString}' status value is invalid.");
        }

        return new ResponseDataCommand(
            $commandString,
            $lightModule,
            $status,
        );
    }

    public function supports(string $commandString): bool
    {
        return 't' === $commandString[0];
    }
}
