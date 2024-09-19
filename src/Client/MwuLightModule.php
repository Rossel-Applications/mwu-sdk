<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Client\Interface\MwuLightModuleInterface;
use MwuSdk\Client\Interface\MwuSwitchInterface;

/**
 * This class is responsible for managing interactions with individual MWU light modules.
 * It provides methods to send specific commands to a light module.
 */
final readonly class MwuLightModule implements MwuLightModuleInterface
{
    public function __construct(
        private MwuSwitchInterface $switch,
        private int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSwitch(): MwuSwitchInterface
    {
        return $this->switch;
    }
}
