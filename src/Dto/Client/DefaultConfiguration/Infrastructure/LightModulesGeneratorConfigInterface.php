<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure;

interface LightModulesGeneratorConfigInterface
{
    public function getFirstModuleId(): ?int;

    public function getIncrementBetweenModuleIds(): ?int;

    public function getNumberOfModules(): ?int;
}
