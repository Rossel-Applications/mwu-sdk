<?php

declare(strict_types=1);

namespace MwuSdk\Client;

/**
 * Interface for the MWU Client.
 *
 * This interface serves as the main entry point for communication
 * with the MWU system, allowing for the management of switches.
 *
 * @see Mwu
 */
interface MwuClientInterface
{
    /**
     * Gets the list of switches managed by the client.
     *
     * @return array<array-key, MwuSwitchInterface> an array of switches
     */
    public function getSwitches(): array;

    /**
     * Adds a switch to the client.
     *
     * @param MwuSwitchInterface $switch the switch to add
     *
     * @return self the instance of the client for method chaining
     */
    public function addSwitch(MwuSwitchInterface $switch): self;

    /**
     * Removes a switch from the client.
     *
     * @param MwuSwitchInterface $switch the switch to remove
     *
     * @return self the instance of the client for method chaining
     */
    public function removeSwitch(MwuSwitchInterface $switch): self;
}
