<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure;

interface LightModulesGeneratorConfigInterface
{
    public function getFirstLightModuleId(): ?int;

    public function getIncrementBetweenLightModuleIds(): ?int;

    public function getNumberOfLightModules(): ?int;
}
