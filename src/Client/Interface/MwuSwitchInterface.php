<?php

declare(strict_types=1);

namespace MwuSdk\Client\Interface;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

interface MwuSwitchInterface
{
    public function getConfig(): SwitchConfigInterface;

    public function getIpAddress(): string;

    public function getPort(): int;

    /**
     * @return array<array-key, MwuLightModuleInterface>
     */
    public function getLightModules(): array;

    public function addLightModule(MwuLightModuleInterface $lightModule): self;

    public function removeLightModule(MwuLightModuleInterface $lightModule): self;

    /**
     * @param array<array-key, MwuLightModuleInterface> $lightModules
     */
    public function removeLightModules(array $lightModules): self;
}
