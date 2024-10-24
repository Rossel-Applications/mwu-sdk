<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Client\MwuSwitch;

use Random\RandomException;
use Rossel\MwuSdk\Builder\Command\Write\WriteCommandBuilderInterface;
use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use Rossel\MwuSdk\Client\TcpIp\TcpIpClient;
use Rossel\MwuSdk\Client\TcpIp\TcpIpClientInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\ClientCommandInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\Initialize\InitializeCommand;
use Rossel\MwuSdk\Entity\Command\ClientCommand\TargetedLightModuleCommandInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\TargetedSwitchCommandInterface;
use Rossel\MwuSdk\Entity\Command\CommandInterface;
use Rossel\MwuSdk\Exception\Client\Switch\LightModuleNotFoundException;
use Rossel\MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use Rossel\MwuSdk\Exception\Configuration\CannotAssignIdOnSwitchException;
use Rossel\MwuSdk\Factory\Client\MwuLightModuleFactoryInterface;
use Rossel\MwuSdk\Factory\Entity\Message\ClientMessage\ClientMessageFactoryInterface;
use Rossel\MwuSdk\Validator\Command\TargetedLightModuleCommandValidatorInterface;
use Rossel\MwuSdk\Validator\Command\TargetedSwitchCommandValidatorInterface;

/**
 * This class represents a network switch that connects multiple MWU light modules.
 * It manages the interaction with the light modules connected to it, enabling individual
 * or batch operations on all modules connected to a specific switch.
 */
final class MwuSwitch implements MwuSwitchInterface
{
    /** @var array<int, MwuLightModuleInterface> */
    private array $lightModules = [];
    private readonly TcpIpClientInterface $tcpIpClient;

    /**
     * @param SwitchConfigInterface $config         configuration of this Switch
     * @param ?list<int>            $lightModuleIds manual list of IDs for which to generate a LightModule. This parameter is optional and overrides the eventual light modules generator configuration.
     */
    public function __construct(
        private readonly SwitchConfigInterface $config,
        private readonly ?BehaviorConfigInterface $defaultBehaviorConfig,
        private readonly ClientMessageFactoryInterface $messageFactory,
        private readonly MwuLightModuleFactoryInterface $lightModuleFactory,
        private readonly TargetedSwitchCommandValidatorInterface $targetedSwitchCommandValidator,
        private readonly TargetedLightModuleCommandValidatorInterface $targetedLightModuleValidator,
        ?array $lightModuleIds = null,
    ) {
        $this->tcpIpClient = new TcpIpClient(
            $this->config->getIpAddress(),
            $this->config->getPort()
        );

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
    public function send(
        ClientCommandInterface $command,
        ?string $sequenceNumber = null
    ): ?string {
        $this->validateCommand($command);

        $message = $this->messageFactory->create($command, $sequenceNumber);

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

    /**
     * @throws RandomException
     * @throws TcpIpClientExceptionInterface
     */
    public function reset(): ?string
    {
        return $this->send(new InitializeCommand());
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
