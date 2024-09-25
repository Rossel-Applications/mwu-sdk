<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Entity\Command\CommandInterface;

/**
 * Interface for MWU Switches.
 *
 * Defines methods for managing switches and connected light modules.
 */
interface MwuSwitchInterface
{
    /** Gets the switch configuration. */
    public function getConfig(): SwitchConfigInterface;

    /** Gets the IP address of the switch. */
    public function getIpAddress(): string;

    /** Gets the communication port used by the switch. */
    public function getPort(): int;

    /** Gets the unique identifier for the switch. */
    public function getUniqueIdentifier(): string;

    /**
     * Gets the connected light modules.
     *
     * @return array<int, MwuLightModuleInterface>
     */
    public function getLightModules(): array;

    /** Connects a light module to the switch. */
    public function connectLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * Connects multiple light modules to the switch.
     *
     * @param list<MwuLightModuleInterface> $lightModules
     */
    public function connectLightModules(array $lightModules): self;

    /** Disconnects a light module from the switch. */
    public function disconnectLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * Disconnects multiple light modules from the switch.
     *
     * @param list<MwuLightModuleInterface> $lightModules
     */
    public function disconnectLightModules(array $lightModules): self;

    /** Defines and assigns an ID to a light module. */
    public function defineLightModule(int $id): self;

    /**
     * Defines and assigns IDs to multiple light modules.
     *
     * @param list<int> $lightModuleIds
     */
    public function defineLightModules(array $lightModuleIds): self;

    /** Disconnects a light module by its ID. */
    public function disconnectLightModuleById(int $id): self;

    /**
     * Disconnects multiple light modules by their IDs.
     *
     * @param list<int> $lightModuleIds
     */
    public function disconnectLightModulesById(array $lightModuleIds): self;

    /** Checks if a light module ID is available. */
    public function isLightModuleIdAvailable(int $id): bool;

    /**
     * Sends a command to the switch.
     */
    public function send(CommandInterface $command): ?string;
}
