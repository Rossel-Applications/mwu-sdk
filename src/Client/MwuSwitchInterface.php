<?php

declare(strict_types=1);

namespace MwuSdk\Client;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Exception\Configuration\CannotAssignIdOnSwitchException;

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

    /** @param list<MwuLightModuleInterface> $lightModules */
    public function addLightModules(array $lightModules): self;

    public function removeLightModule(MwuLightModuleInterface $lightModule): self;

    /** @param list<MwuLightModuleInterface> $lightModules */
    public function removeLightModules(array $lightModules): self;

    /**
     * @throws CannotAssignIdOnSwitchException
     */
    public function defineLightModule(int $id): self;

    /**
     * @param list<int> $lightModuleIds
     */
    public function defineLightModules(array $lightModuleIds): self;

    public function removeLightModuleById(int $id): self;

    /**
     * @param list<int> $lightModuleIds
     */
    public function removeLightModulesById(array $lightModuleIds): self;

    public function getUniqueIdentifier(): string;

    public function isIdAvailable(int $id): bool;
}
