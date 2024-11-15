<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure;

use Symfony\Component\Validator\Constraints as Assert;

class LightModulesGeneratorConfig implements LightModulesGeneratorConfigInterface
{
    #[Assert\GreaterThanOrEqual(0)]
    private int $firstModuleId;

    #[Assert\GreaterThanOrEqual(0)]
    private int $numberOfModules;

    #[Assert\NotEqualTo(0)]
    private int $incrementBetweenModuleIds;

    public function __construct(
        int $firstModuleId,
        int $numberOfModules,
        int $incrementBetweenModuleIds = 1
    ) {
        $this->firstModuleId = $firstModuleId;
        $this->numberOfModules = $numberOfModules;
        $this->incrementBetweenModuleIds = $incrementBetweenModuleIds;
    }

    public function getFirstModuleId(): ?int
    {
        return $this->firstModuleId;
    }

    public function getNumberOfModules(): int
    {
        return $this->numberOfModules;
    }

    public function getIncrementBetweenModuleIds(): int
    {
        return $this->incrementBetweenModuleIds;
    }
}
