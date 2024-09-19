<?php

declare(strict_types=1);

namespace MwuSdk\Client\Interface;

interface MwuLightModuleInterface
{
    public function getId(): int;

    public function getSwitch(): MwuSwitchInterface;
}
