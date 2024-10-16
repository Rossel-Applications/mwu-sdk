<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ServerCommand\ResponseData;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\AbstractCommand;
use MwuSdk\Enum\Command\ResponseData\Status;

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
