<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ServerCommand\ResponseData;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\AbstractCommand;
use MwuSdk\Enum\Command\ResponseData\Status;
use MwuSdk\Exception\Client\LightModule\UnreachableLightModuleException;

final readonly class ResponseDataCommand extends AbstractCommand implements ResponseDataCommandInterface
{
    public function __construct(
        string $stringCommand,
        private MwuLightModuleInterface $lightModule,
        private Status $status,
        private ?string $data,
    ) {
        parent::__construct($stringCommand);
    }

    public function __toString(): string
    {
        return $this->getCommandTemplate();
    }

    public function getSwitch(): MwuSwitchInterface
    {
        $switch = $this->getLightModule()->getSwitch();

        if (null === $switch) {
            throw new UnreachableLightModuleException($this->getLightModule());
        }

        return $switch;
    }

    public function getLightModule(): MwuLightModuleInterface
    {
        return $this->lightModule;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getData(): ?string
    {
        return $this->data;
    }
}
