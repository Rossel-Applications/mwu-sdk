<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use MwuSdk\Entity\Command\BroadcastReadyCommandInterface;

/**
 * The MWU client class serves as the primary implementation for managing and interacting with
 * MWU light modules and switches. It allows for adding, removing, and sending commands to switches
 * either individually or in bulk.
 */
final class Mwu implements MwuClientInterface
{
    /**
     * @var array<string, MwuSwitchInterface> Associative array where the keys are switch identifiers (e.g., IP addresses or unique IDs)
     *                                        and the values are instances of MwuSwitchInterface.
     */
    private array $switches;

    /**
     * Initializes the MWU client with a set of switches.
     *
     * @param array<string, MwuSwitchInterface> $switches an array of switches to be managed by the client, where the keys are switch identifiers
     *                                                    and the values are MwuSwitchInterface objects
     */
    public function __construct(array $switches)
    {
        $this->switches = $switches;
    }

    /**
     * {@inheritDoc}
     */
    public function getSwitches(): array
    {
        return $this->switches;
    }

    /**
     * {@inheritDoc}
     */
    public function addSwitch(MwuSwitchInterface $switch): self
    {
        $this->switches[$switch->getUniqueIdentifier()] = $switch;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeSwitch(MwuSwitchInterface $switch): self
    {
        unset($this->switches[$switch->getUniqueIdentifier()]);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<array-key, string|null> responses from switches
     */
    public function send(BroadcastReadyCommandInterface $command, array $switches): array
    {
        $responses = [];

        foreach ($switches as $switch) {
            $responses[$switch->getUniqueIdentifier()] = $switch->send($command);
        }

        return $responses;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<array-key, string|null> responses from switches
     */
    public function broadcast(BroadcastReadyCommandInterface $command): array
    {
        return $this->send($command, $this->getSwitches());
    }

    /**
     * {@inheritDoc}
     *
     * @return array<string, array<int, string|null>> responses from light modules, grouped by switch
     */
    public function write(
        array $switches,
        WriteCommandBuilderInterface $builder,
        string $text = '',
        array &$errors = [],
    ): array {
        $responses = [];

        foreach ($switches as $switch) {
            $switchId = $switch->getUniqueIdentifier();
            $switchResponses = $switch->broadcastWrite($builder, $text, $errors);
            $responses[$switchId] = $switchResponses;
        }

        return $responses;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<string, array<int, string|null>> responses from light modules, grouped by switch
     */
    public function broadcastWrite(
        WriteCommandBuilderInterface $builder,
        string $text = '',
        array &$errors = [],
    ): array {
        return $this->write($this->getSwitches(), $builder, $text, $errors);
    }
}
