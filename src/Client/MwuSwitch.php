<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Exception\Configuration\CannotAssignIdOnSwitchException;

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
     * @param list<int> $lightModuleIds
     */
    public function __construct(
        private readonly SwitchConfigInterface $config,
        array $lightModuleIds = [],
    ) {
        $this->defineLightModules($lightModuleIds);
    }

    public function getConfig(): SwitchConfigInterface
    {
        return $this->config;
    }

    public function getIpAddress(): string
    {
        return $this->getConfig()->getIpAddress();
    }

    public function getPort(): int
    {
        return $this->getConfig()->getPort();
    }

    /**
     * @return array<int, MwuLightModuleInterface>
     */
    public function getLightModules(): array
    {
        return $this->lightModules;
    }

    public function addLightModule(MwuLightModuleInterface $lightModule): self
    {
        $requestedId = $lightModule->getId();

        if (null === $requestedId || !$this->isIdAvailable($requestedId)) {
            throw new CannotAssignIdOnSwitchException($this, $requestedId);
        }

        $this->lightModules[$requestedId] = $lightModule;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addLightModules(array $lightModules): self
    {
        foreach ($lightModules as $lightModule) {
            $this->addLightModule($lightModule);
        }

        return $this;
    }

    public function removeLightModule(MwuLightModuleInterface $lightModule): self
    {
        $lightModuleId = $lightModule->getId();

        if (null === $lightModuleId) {
            return $this;
        }

        return $this->removeLightModuleById($lightModuleId);
    }

    /**
     * @inheritDoc
     */
    public function removeLightModules(array $lightModules): self
    {
        foreach ($lightModules as $lightModule) {
            $this->removeLightModule($lightModule);
        }

        return $this;
    }

    public function defineLightModule(int $id): self
    {
        $this->lightModules[$id] = new MwuLightModule($this, $id);

        return $this;
    }

    /** @inheritDoc */
    public function defineLightModules(array $lightModuleIds): self
    {
        foreach ($lightModuleIds as $lightModuleId) {
            $this->defineLightModule($lightModuleId);
        }

        return $this;
    }

    public function removeLightModuleById(int $id): self
    {
        $lightModule = $this->getLightModules()[$id];

        if (null !== $lightModule && null !== $lightModule->getSwitch()) {
            $lightModule->disconnectSwitch();
        }

        unset($this->getLightModules()[$id]);

        return $this;
    }

    /** @inheritDoc */
    public function removeLightModulesById(array $lightModuleIds): self
    {
        foreach ($lightModuleIds as $lightModuleId) {
            $this->removeLightModuleById($lightModuleId);
        }

        return $this;
    }

    public function getUniqueIdentifier(): string
    {
        return $this->getIpAddress().':'.$this->getPort();
    }

    public function isIdAvailable(int $id): bool
    {
        return !\array_key_exists($id, $this->getLightModules());
    }
}
