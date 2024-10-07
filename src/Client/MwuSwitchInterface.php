<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Entity\Command\CommandInterface;

/**
 * Interface for MWU Switches.
 *
 * Defines methods for managing switches and connected light modules.
 */
interface MwuSwitchInterface
{
    public function __toString(): string;

    /**
     * Checks if the specified switch is equal to this one.
     */
    public function equals(?self $switch): bool;

    /**
     * Returns the switch configuration.
     */
    public function getConfig(): SwitchConfigInterface;

    /**
     * Returns the switch IP address.
     */
    public function getIpAddress(): string;

    /**
     * Returns the switch port.
     */
    public function getPort(): int;

    /**
     * Returns the unique identifier of the switch.
     */
    public function getUniqueIdentifier(): string;

    /**
     * Returns the connected light modules.
     *
     * @return array<int, MwuLightModuleInterface>
     */
    public function getLightModules(): array;

    /**
     * Returns the light module corresponding to the specified ID.
     */
    public function getLightModuleById(int $id): ?MwuLightModuleInterface;

    /**
     * Returns an array containing the light modules corresponding to the specified IDs.
     *
     * @param list<int> $ids
     *
     * @return array<int, MwuLightModuleInterface>
     */
    public function getLightModulesByIds(array $ids): array;

    /**
     * Connects a light module to the switch.
     */
    public function connectLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * Connects multiple light modules.
     *
     * @param list<MwuLightModuleInterface> $lightModules
     */
    public function connectLightModules(array $lightModules): self;

    /**
     * Disconnects a light module.
     */
    public function disconnectLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * Disconnects multiple light modules.
     *
     * @param list<MwuLightModuleInterface> $lightModules
     */
    public function disconnectLightModules(array $lightModules): self;

    /**
     * Assigns an ID to a light module.
     */
    public function defineLightModule(int $id): self;

    /**
     * Assigns IDs to multiple light modules.
     *
     * @param list<int> $lightModuleIds
     */
    public function defineLightModules(array $lightModuleIds): self;

    /**
     * Disconnects a light module by its ID.
     *
     * @return bool whether the light module was successfully disconnected
     */
    public function disconnectLightModuleById(int $id): bool;

    /**
     * Disconnects multiple light modules by their IDs.
     *
     * @param list<int> $lightModuleIds
     */
    public function disconnectLightModulesById(array $lightModuleIds): self;

    /**
     * Checks if a light module ID is available.
     */
    public function isLightModuleIdAvailable(int $id): bool;

    /**
     * Sends a command to the switch.
     *
     * @return ?string the response, or null if no response
     */
    public function send(CommandInterface $command): ?string;

    /**
     * Builds and sends a write command to specified light modules.
     *
     * @param array<array-key, MwuLightModuleInterface> $lightModules   list of light modules
     * @param WriteCommandBuilderInterface              $commandBuilder command builder
     * @param string                                    $text           text to write
     * @param list<\Exception>                          $errors         reference to capture errors
     *
     * @return array<int, string|null> responses from light modules, indexed by light module IDs
     */
    public function write(
        array $lightModules,
        WriteCommandBuilderInterface $commandBuilder,
        ?string $text = null,
        array &$errors = [],
    ): array;

    /**
     * Builds and sends a write command to all connected light modules.
     *
     * @param WriteCommandBuilderInterface $commandBuilder command builder
     * @param string                       $text           text to write
     * @param list<\Exception>             $errors         reference to capture errors
     *
     * @return array<int, string|null> responses from light modules
     */
    public function broadcastWrite(
        WriteCommandBuilderInterface $commandBuilder,
        ?string $text = null,
        array &$errors = [],
    ): array;
}
