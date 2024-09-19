<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Exception\Configuration\CannotAssignIdOnSwitchException;

/**
 * Interface implemented by MWU Switches.
 */
interface MwuSwitchInterface
{
    /** Returns the switch configuration object (used to instantiate the Switch client). */
    public function getConfig(): SwitchConfigInterface;

    /** Returns the IP address of the Switch. */
    public function getIpAddress(): string;

    /** Returns the port used on the Switch to communicate with the MWU system. */
    public function getPort(): int;

    /** Returns a unique identifier representing the Switch (e.g., its IP address and attached port). */
    public function getUniqueIdentifier(): string;

    /**
     * Returns all the Light Modules currently connected to the Switch.
     *
     * @return array<array-key, MwuLightModuleInterface> list of connected Light Modules
     */
    public function getLightModules(): array;

    /**
     * Connect a new Light Module to the Switch.
     *
     * @note The Light Module <b>MUST</b> already have an ID value at this stage. This method is responsible for validating its availability before connecting it to the Switch.
     *
     * @param MwuLightModuleInterface $lightModule the Light Module to be connected
     *
     * @see MwuSwitchInterface::connectLightModules()
     */
    public function connectLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * Connect multiple Light Modules to the Switch.
     *
     * @param list<MwuLightModuleInterface> $lightModules list of Light Modules to be connected
     *
     * @see MwuSwitchInterface::connectLightModule()
     */
    public function connectLightModules(array $lightModules): self;

    /**
     * Disconnect a Light Module from the Switch.
     *
     * @param MwuLightModuleInterface $lightModule the Light Module to be disconnected
     *
     * @see MwuSwitchInterface::disconnectLightModules()
     */
    public function disconnectLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * Disconnect multiple Light Modules from the Switch.
     *
     * @param list<MwuLightModuleInterface> $lightModules list of Light Modules to be disconnected
     *
     * @see MwuSwitchInterface::disconnectLightModule()
     */
    public function disconnectLightModules(array $lightModules): self;

    /**
     * Creates a new Light Module and assigns the specified ID to it, if available.
     *
     * @param int $id the ID to assign to the new Light Module
     *
     * @throws CannotAssignIdOnSwitchException if the ID cannot be assigned
     */
    public function defineLightModule(int $id): self;

    /**
     * Creates new Light Modules and assigns the specified IDs to them.
     *
     * @param list<int> $lightModuleIds list of IDs to assign to the Light Modules
     */
    public function defineLightModules(array $lightModuleIds): self;

    /**
     * Disconnect a Light Module by its ID.
     *
     * @param int $id the ID of the Light Module to disconnect
     */
    public function disconnectLightModuleById(int $id): self;

    /**
     * Disconnect multiple Light Modules by their IDs.
     *
     * @param list<int> $lightModuleIds list of Light Module IDs to disconnect
     */
    public function disconnectLightModulesById(array $lightModuleIds): self;

    /**
     * Checks if a given Light Module ID is available.
     *
     * @param int $id the ID to check
     *
     * @return bool true if the ID is available, false otherwise
     */
    public function isLightModuleIdAvailable(int $id): bool;
}
