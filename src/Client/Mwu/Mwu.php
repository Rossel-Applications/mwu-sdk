<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Client\Mwu;

use Rossel\MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\MwuConfigInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\BroadcastReadyCommandInterface;
use Rossel\MwuSdk\Exception\Client\Mwu\SwitchNotFoundException;
use Rossel\MwuSdk\Factory\Client\MwuSwitchFactoryInterface;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\ConfigDenormalizer;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Formats\YamlConfigurationDeserializerInterface;

/**
 * Abstract class for managing a collection of switches and sending commands.
 * Supports broadcasting commands and writing data to switches and light modules.
 * This class is intended to be extended and serves as the main entry point for interacting with the MWU system.
 */
class Mwu implements YamlConfigurableMwuServiceInterface
{
    /**
     * @var array<int, MwuSwitchInterface> list of switches managed by the client
     */
    private array $switches = [];

    /**
     * @param array<string, mixed> $defaultConfig
     */
    public function __construct(
        array $defaultConfig,
        private readonly MwuSwitchFactoryInterface $switchFactory,
        private readonly YamlConfigurationDeserializerInterface $yamlConfigurationDeserializer,
        private readonly ConfigDenormalizer $configDenormalizer,
    ) {
        $this->loadConfiguration($defaultConfig);
    }

    /**
     * {@inheritDoc}
     */
    public function loadConfiguration(array|MwuConfigInterface $config): self
    {
        if (\is_array($config)) {
            $denormalizedConfig = $this->configDenormalizer->denormalize($config);
        } else {
            $denormalizedConfig = $config;
        }

        $this->switches = $this->switchFactory->createCollection(
            $denormalizedConfig->getSwitches(),
            $denormalizedConfig->getBehavior()
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function loadYamlConfigurationFile(string $path): self
    {
        $config = $this->yamlConfigurationDeserializer->parseConfigurationFile($path);

        return $this->loadConfiguration($config);
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
    public function getSwitchById(int $id): MwuSwitchInterface
    {
        return $this->getSwitches()[$id] ?? throw new SwitchNotFoundException($id);
    }

    /**
     * {@inheritDoc}
     *
     * @return array<int, MwuSwitchInterface>
     */
    public function getSwitchesByIds(array $ids): array
    {
        $switches = [];

        foreach ($ids as $id) {
            $switches[$id] = $this->getSwitchById($id);
        }

        return $switches;
    }

    /**
     * {@inheritDoc}
     */
    public function addSwitch(MwuSwitchInterface $switch): self
    {
        $this->switches[] = $switch;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addSwitches(array $switches): self
    {
        foreach ($switches as $switch) {
            $this->addSwitch($switch);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeSwitch(MwuSwitchInterface $switch): self
    {
        unset($this->switches[array_search($switch, $this->switches, true)]);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeSwitches(array $switches): self
    {
        foreach ($switches as $switch) {
            $this->removeSwitch($switch);
        }

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

    /**
     * @param array<array-key, MwuSwitchInterface> $switches
     *
     * @return array<string, string|null>
     */
    public function reset(array $switches): array
    {
        $responses = [];

        foreach ($switches as $switch) {
            $switchId = $switch->getUniqueIdentifier();
            $switchResponse = $switch->reset();
            $responses[$switchId] = $switchResponse;
        }

        return $responses;
    }

    public function broadcastReset(): array
    {
        return $this->reset($this->getSwitches());
    }
}
