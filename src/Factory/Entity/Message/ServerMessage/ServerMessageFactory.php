<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Message\ServerMessage;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use Rossel\MwuSdk\Entity\Message\ServerMessage\ServerMessage;
use Rossel\MwuSdk\Factory\Entity\Command\Server\ResponseData\ResponseDataCommandFactoryInterface;
use Rossel\MwuSdk\Factory\Entity\Command\Server\SuccessfulResponse\SuccessfulResponseCommandFactoryInterface;

final readonly class ServerMessageFactory implements ServerMessageFactoryInterface
{
    public function __construct(
        private ResponseDataCommandFactoryInterface $responseDataCommandFactory,
        private SuccessfulResponseCommandFactoryInterface $successfulResponseCommandFactory,
    ) {
    }

    public function createFromString(MwuSwitchInterface $switch, string $message): ServerMessage
    {
        $sequenceNumber = substr($message, 1, 3);

        $commandLength = substr($message, 4, 4);

        if (false === is_numeric($commandLength)) {
            throw new \InvalidArgumentException('Command length must be numeric');
        }

        $commandLengthInt = (int) $commandLength;

        $commandString = substr($message, 8, $commandLengthInt);

        $command = $this->createCommand($switch, $commandString);

        return new ServerMessage(
            $command,
            $sequenceNumber
        );
    }

    private function createCommand(MwuSwitchInterface $switch, string $commandString): ServerCommandInterface
    {
        $command = match (true) {
            $this->responseDataCommandFactory->supports($commandString) => $this->responseDataCommandFactory->createFromString($switch, $commandString),
            $this->successfulResponseCommandFactory->supports($commandString) => $this->successfulResponseCommandFactory->createFromString($switch, $commandString),
            default => null,
        };

        if (null === $command) {
            throw new \InvalidArgumentException("Command '$commandString' is not supported");
        }

        return $command;
    }
}
