<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use MwuSdk\Entity\Command\BroadcastReadyCommandInterface;

/**
 * MwuClientInterface defines methods for managing switches and sending commands.
 * It supports operations like adding/removing switches, sending and broadcasting commands, and writing data to light modules.
 */
interface MwuClientInterface
{
    /**
     * Gets the list of switches managed by the client.
     *
     * @return list<MwuSwitchInterface> list of the connected switches
     */
    public function getSwitches(): array;

    /**
     * Returns the switch corresponding to the specified ID.
     */
    public function getSwitchById(int $id): MwuSwitchInterface;

    /**
     * Returns switches corresponding to the specified IDs.
     *
     * @param list<int> $ids
     *
     * @return array<int, MwuSwitchInterface>
     */
    public function getSwitchesByIds(array $ids): array;

    /**
     * Adds a switch to the client.
     *
     * @param MwuSwitchInterface $switch the switch to add to the client
     *
     * @return self returns the current instance for method chaining
     */
    public function addSwitch(MwuSwitchInterface $switch): self;

    /**
     * Removes a switch from the client.
     *
     * @param MwuSwitchInterface $switch the switch to remove from the client
     *
     * @return self returns the current instance for method chaining
     */
    public function removeSwitch(MwuSwitchInterface $switch): self;

    /**
     * Sends the specified command to the provided switches.
     *
     * @param BroadcastReadyCommandInterface $command  the command to send to each switch
     * @param list<MwuSwitchInterface>       $switches list of switches
     *
     * @return array<array-key, string|null> responses from switches
     */
    public function send(BroadcastReadyCommandInterface $command, array $switches): array;

    /**
     * Sends the specified command to all switches connected to the MWU client.
     *
     * @param BroadcastReadyCommandInterface $command the command to send to all connected switches
     *
     * @return array<array-key, string|null> responses from switches
     */
    public function broadcast(BroadcastReadyCommandInterface $command): array;

    /**
     * Builds and sends commands, from a command builder, to specified switches.
     *
     * @param WriteCommandBuilderInterface         $builder  the command builder that generates commands for the light modules connected to the switches
     * @param array<array-key, MwuSwitchInterface> $switches array of switches whose light modules will receive the command
     * @param string                               $text     text to write
     * @param list<\Exception>                     $errors   reference to capture errors
     *
     * @return array<string, array<int, string|null>> responses from light modules, grouped by switch
     */
    public function write(
        array $switches,
        WriteCommandBuilderInterface $builder,
        string $text = '',
        array &$errors = [],
    ): array;

    /**
     * Builds and sends commands, from a command builder, to all switches connected to the MWU client.
     *
     * @param WriteCommandBuilderInterface $builder the command builder that generates commands for the light modules connected to the switches
     * @param string                       $text    text to write
     * @param list<\Exception>             $errors  reference to capture errors
     *
     * @return array<string, array<int, string|null>> responses from light modules, grouped by switch
     */
    public function broadcastWrite(
        WriteCommandBuilderInterface $builder,
        string $text = '',
        array &$errors = [],
    ): array;
}
