<?php

declare(strict_types=1);

namespace MwuSdk\Client;

interface MwuClientInterface
{
    /**
     * @return array<array-key, MwuSwitchInterface>
     */
    public function getSwitches(): array;

    public function addSwitch(MwuSwitchInterface $switch): self;

    public function removeSwitch(MwuSwitchInterface $switch): self;
}
