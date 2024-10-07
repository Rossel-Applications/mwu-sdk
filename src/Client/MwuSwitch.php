<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Entity\Command\CommandInterface;
use MwuSdk\Entity\Command\TargetedLightModuleCommandInterface;
use MwuSdk\Entity\Command\TargetedSwitchCommandInterface;
use MwuSdk\Exception\Client\Switch\LightModuleNotFoundException;
use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use MwuSdk\Exception\Configuration\CannotAssignIdOnSwitchException;
use MwuSdk\Factory\Client\MwuLightModuleFactoryInterface;
use MwuSdk\Factory\Entity\MessageFactoryInterface;
use MwuSdk\Validator\Command\TargetedLightModuleCommandValidatorInterface;
use MwuSdk\Validator\Command\TargetedSwitchCommandValidatorInterface;
use Random\RandomException;

/**
 * This class represents a network switch that connects multiple MWU light modules.
 * It manages the interaction with the light modules connected to it, enabling individual
 * or batch operations on all modules connected to a specific switch.
 */
final class MwuSwitch implements MwuSwitchInterface
{
    /** @var array<int, MwuLightModuleInterface> */
    private array $lightModules = [];

    /**
     * @param SwitchConfigInterface $config         configuration of this Switch
     * @param ?list<int>            $lightModuleIds manual list of IDs for which to generate a LightModule. This parameter is optional and overrides the eventual light modules generator configuration.
     */
    public function __construct(
        private readonly SwitchConfigInterface $config,
        private readonly ?BehaviorConfigInterface $defaultBehaviorConfig,
        private readonly TcpIpClientInterface $tcpIpClient,
        private readonly MessageFactoryInterface $messageFactory,
        private readonly MwuLightModuleFactoryInterface $lightModuleFactory,
        private readonly TargetedSwitchCommandValidatorInterface $targetedSwitchCommandValidator,
        private readonly TargetedLightModuleCommandValidatorInterface $targetedLightModuleValidator,
        ?array $lightModuleIds = null,
    ) {
        $this->tcpIpClient->configure($this);

        if (null !== $lightModuleIds) {
            $this->defineLightModules($lightModuleIds);

            return;
        }

        $lightModulesGeneratorConfig = $this->config->getLightModulesGeneratorConfig();
        $this->lightModuleFactory->generateCollection($lightModulesGeneratorConfig, $this, $this->defaultBehaviorConfig);
    }

    public function __toString(): string
    {
        return $this->getIpAddress().':'.$this->getPort();
    }

    /**
     * {@inheritDoc}
     */
    public function equals(?MwuSwitchInterface $switch): bool
    {
        return null !== $switch
            && $this->getIpAddress() === $switch->getIpAddress()
            && $this->getPort() === $switch->getPort();
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig(): SwitchConfigInterface
    {
        return $this->config;
    }

    /**
     * {@inheritDoc}
     */
    public function getIpAddress(): string
    {
        return $this->getConfig()->getIpAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function getPort(): int
    {
        return $this->getConfig()->getPort();
    }

    /**
     * {@inheritDoc}
     *
     * @return array<int, MwuLightModuleInterface>
     */
    public function getLightModules(): array
    {
        return $this->lightModules;
    }

    /**
     * {@inheritDoc}
     */
    public function getLightModuleById(int $id): ?MwuLightModuleInterface
    {
        return $this->lightModules[$id] ?? null;
    }

    /**
     * {@inheritDoc}
     *
     * @throws LightModuleNotFoundException
     *
     * @return array<int, MwuLightModuleInterface>
     */
    public function getLightModulesByIds(array $ids): array
    {
        $lightModules = [];

        foreach ($ids as $id) {
            $lightModule = $this->getLightModuleById($id);

            if (null !== $lightModule) {
                $lightModules[$id] = $lightModule;

                continue;
            }

            throw new LightModuleNotFoundException($id);
        }

        return $lightModules;
    }

    /**
     * {@inheritDoc}
     */
    public function connectLightModule(MwuLightModuleInterface $lightModule): self
    {
        $requestedId = $lightModule->getId();

        if (null === $requestedId || !$this->isLightModuleIdAvailable($requestedId)) {
            throw new CannotAssignIdOnSwitchException($this, $requestedId);
        }

        $this->lightModules[$requestedId] = $lightModule;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function connectLightModules(array $lightModules): self
    {
        foreach ($lightModules as $lightModule) {
            $this->connectLightModule($lightModule);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disconnectLightModule(MwuLightModuleInterface $lightModule): self
    {
        $lightModuleId = $lightModule->getId();

        if (null !== $lightModuleId) {
            $this->disconnectLightModuleById($lightModuleId);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disconnectLightModules(array $lightModules): self
    {
        foreach ($lightModules as $lightModule) {
            $this->disconnectLightModule($lightModule);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function defineLightModule(int $id): self
    {
        $this->lightModules[$id] = $this->lightModuleFactory->create($this, $id, $this->defaultBehaviorConfig);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function defineLightModules(array $lightModuleIds): self
    {
        foreach ($lightModuleIds as $lightModuleId) {
            $this->defineLightModule($lightModuleId);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disconnectLightModuleById(int $id): bool
    {
        $lightModule = $this->lightModules[$id] ?? null;

        if (null !== $lightModule && null !== $lightModule->getSwitch()) {
            $lightModule->disconnectSwitch();
        }

        unset($this->lightModules[$id]);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function disconnectLightModulesById(array $lightModuleIds): self
    {
        foreach ($lightModuleIds as $lightModuleId) {
            $this->disconnectLightModuleById($lightModuleId);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUniqueIdentifier(): string
    {
        return (string) $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isLightModuleIdAvailable(int $id): bool
    {
        return !\array_key_exists($id, $this->getLightModules());
    }

    /**
     * {@inheritDoc}
     *
     * @throws RandomException
     * @throws TcpIpClientExceptionInterface
     */
    public function send(CommandInterface $command): ?string
    {
        $this->validateCommand($command);

        $message = $this->messageFactory->create($command);

        return $this->tcpIpClient->sendMessage((string) $message);
    }

    /**
     * {@inheritDoc}
     *
     * @throws TcpIpClientExceptionInterface
     * @throws RandomException
     *
     * @return array<int, string|null> responses from light modules, indexed by light module IDs
     */
    public function write(
        array $lightModules,
        WriteCommandBuilderInterface $commandBuilder,
        ?string $text = null,
        array &$errors = [],
    ): array {
        $responses = [];
        $commands = $commandBuilder->buildCommands($lightModules, $text, $errors);

        foreach ($commands as $id => $command) {
            $responses[$id] = $this->send($command);
        }

        return $responses;
    }

    /**
     * {@inheritDoc}
     *
     * @throws TcpIpClientExceptionInterface
     * @throws RandomException
     *
     * @return array<int, string|null> responses from light modules, indexed by light module IDs
     */
    public function broadcastWrite(
        WriteCommandBuilderInterface $commandBuilder,
        ?string $text = null,
        array &$errors = [],
    ): array {
        return $this->write(
            $this->getLightModules(),
            $commandBuilder,
            $text,
            $errors,
        );
    }

    private function validateCommand(CommandInterface $command): void
    {
        if ($command instanceof TargetedLightModuleCommandInterface) {
            $this->targetedLightModuleValidator->validate($command, $this);

            return;
        }

        if ($command instanceof TargetedSwitchCommandInterface) {
            $this->targetedSwitchCommandValidator->validate($command, $this);
        }
    }
}
