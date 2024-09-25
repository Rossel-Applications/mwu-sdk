<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure;

use Symfony\Component\Validator\Constraints as Assert;

class LightModulesGeneratorConfig implements LightModulesGeneratorConfigInterface
{
    #[Assert\GreaterThanOrEqual(0)]
    private int $firstLightModuleId;

    #[Assert\GreaterThanOrEqual(0)]
    private int $numberOfLightModules;

    #[Assert\NotEqualTo(0)]
    private int $incrementBetweenLightModuleIds;

    public function __construct(
        int $firstLightModuleId,
        int $numberOfLightModules,
        int $incrementBetweenLightModuleIds = 1
    ) {
        $this->firstLightModuleId = $firstLightModuleId;
        $this->numberOfLightModules = $numberOfLightModules;
        $this->incrementBetweenLightModuleIds = $incrementBetweenLightModuleIds;
    }

    public function getFirstLightModuleId(): ?int
    {
        return $this->firstLightModuleId;
    }

    public function getNumberOfLightModules(): int
    {
        return $this->numberOfLightModules;
    }

    public function getIncrementBetweenLightModuleIds(): int
    {
        return $this->incrementBetweenLightModuleIds;
    }
}
