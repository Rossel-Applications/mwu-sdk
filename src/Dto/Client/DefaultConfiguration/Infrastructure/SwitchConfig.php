<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure;

use Symfony\Component\Validator\Constraints as Assert;

final class SwitchConfig implements SwitchConfigInterface
{
    public const MIN_PORT_VALUE = 1;
    public const MAX_PORT_VALUE = 65535;

    private string $ipAddress;

    #[Assert\Range(min: self::MIN_PORT_VALUE, max: self::MAX_PORT_VALUE)]
    private int $port;

    private LightModulesGeneratorConfigInterface $lightModulesGeneratorConfig;

    public function __construct(
        string $ipAddress,
        int $port,
        LightModulesGeneratorConfigInterface $lightModulesGeneratorConfig,
    ) {
        $this->ipAddress = $ipAddress;
        $this->port = $port;
        $this->lightModulesGeneratorConfig = $lightModulesGeneratorConfig;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getLightModulesGeneratorConfig(): LightModulesGeneratorConfigInterface
    {
        return $this->lightModulesGeneratorConfig;
    }
}
