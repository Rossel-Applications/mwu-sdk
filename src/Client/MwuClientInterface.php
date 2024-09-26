<?php

declare(strict_types=1);

namespace MwuSdk\Client;

/**
 * Interface implemented by the main MWU Client, used as an entry point to communicate with the MWU system.
 *
 * @see Mwu
 * */
interface MwuClientInterface
{
    /**
     * @return array<array-key, MwuSwitchInterface>
     */
    public function getSwitches(): array;

    public function addSwitch(MwuSwitchInterface $switch): self;

    public function removeSwitch(MwuSwitchInterface $switch): self;
}
