<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Command\Server\ResponseData;

use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ServerCommand\ResponseData\ResponseDataCommand;
use Rossel\MwuSdk\Enum\Command\ResponseData\Status;
use Rossel\MwuSdk\Exception\Client\Mwu\SwitchNotFoundException;

final class ResponseDataCommandFactory implements ResponseDataCommandFactoryInterface
{
    public function supports(string $commandString): bool
    {
        return 't' === $commandString[0];
    }

    public function createFromString(
        MwuSwitchInterface $switch,
        string $commandString
    ): ResponseDataCommand {
        if (false === $this->supports($commandString)) {
            throw new \InvalidArgumentException("Command string '{$commandString}' is not supported.");
        }

        return new ResponseDataCommand(
            $commandString,
            $this->fetchLightModule($commandString, $switch),
            $this->fetchStatus($commandString),
            $this->fetchData($commandString),
        );
    }

    private function fetchData(string $commandString): ?string
    {
        if (preg_match('/<([^>]*)>/', $commandString, $matches)) {
            return trim($matches[1]); // Text between "<" and ">"
        }

        return null;
    }

    private function fetchStatus(string $commandString): Status
    {
        $status = Status::findInstanceByStringValue(substr($commandString, 5, 2));

        if (null === $status) {
            throw new \InvalidArgumentException("Command string '{$commandString}' contains an invalid status value.");
        }

        return $status;
    }

    private function fetchLightModule(string $commandString, MwuSwitchInterface $switch): MwuLightModuleInterface
    {
        $lightModuleAddress = substr($commandString, 1, 4);

        if (false === is_numeric($lightModuleAddress)) {
            throw new \InvalidArgumentException("Command string '{$commandString}' does not contain a valid light module address.");
        }

        $lightModuleAddressInt = (int) $lightModuleAddress;

        $lightModule = $switch->getLightModuleById($lightModuleAddressInt);

        if (null === $lightModule) {
            throw new SwitchNotFoundException($lightModuleAddressInt);
        }

        return $lightModule;
    }
}
