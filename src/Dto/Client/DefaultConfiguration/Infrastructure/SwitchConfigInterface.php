<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure;

interface SwitchConfigInterface
{
    public function getIpAddress(): string;

    public function getPort(): int;

    public function getLightModulesGeneratorConfig(): LightModulesGeneratorConfigInterface;
}