<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Client\Interface\MwuLightModuleInterface;
use MwuSdk\Client\Interface\MwuSwitchInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use MwuSdk\Factory\MwuLightModuleFactory;

/**
 * This class represents a network switch that connects multiple MWU light modules.
 * It manages the interaction with the light modules connected to it, enabling individual
 * or batch operations on all modules connected to a specific switch.
 */
final class MwuSwitch implements MwuSwitchInterface
{
    /** @var array<array-key, MwuLightModuleInterface> */
    private array $lightModules;

    public function __construct(
        private readonly SwitchConfig $config,
        MwuLightModuleFactory $lightModuleFactory
    ) {
        $lightModuleFactory->createCollectionFromGenerator(
            $this->config->getLightModulesGeneratorConfig(),
            $this,
        );
    }

    public function getConfig(): SwitchConfig
    {
        return $this->config;
    }

    public function getIpAddress(): string
    {
        return $this->config->getIpAddress();
    }

    public function getPort(): int
    {
        return $this->config->getPort();
    }

    /**
     * @return array<array-key, MwuLightModuleInterface>
     */
    public function getLightModules(): array
    {
        return $this->lightModules;
    }

    public function addLightModule(MwuLightModuleInterface $lightModule): self
    {
        $this->lightModules[] = $lightModule;

        return $this;
    }

    public function removeLightModule(MwuLightModuleInterface $lightModule): self
    {
        return $this->removeLightModules([$lightModule]);
    }

    /**
     * @param array<array-key, MwuLightModuleInterface> $lightModules
     */
    public function removeLightModules(array $lightModules): self
    {
        $this->lightModules = array_diff($this->lightModules, $lightModules);

        return $this;
    }
}
