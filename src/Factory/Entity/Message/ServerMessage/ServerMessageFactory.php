<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Message\ServerMessage;

use http\Exception\InvalidArgumentException;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Entity\Command\ServerCommand\ServerCommandInterface;
use MwuSdk\Entity\Message\ServerMessage\ServerMessage;
use MwuSdk\Factory\Entity\Command\Server\ResponseData\ResponseDataCommandFactory;

class ServerMessageFactory implements ServerMessageFactoryInterface
{
    public function __construct(
        private ResponseDataCommandFactory $responseDataCommandFactory,
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
            default => null,
        };

        if (null === $command) {
            throw new InvalidArgumentException('Command not supported');
        }

        return $command;
    }
}
