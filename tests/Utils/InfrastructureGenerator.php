<?php

declare(strict_types=1);

namespace Rossel\MwuSdkTest\Utils;

use Random\RandomException;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitch;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfig;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use Rossel\MwuSdk\Factory\Client\MwuLightModuleFactory;
use Rossel\MwuSdk\Factory\Client\MwuSwitchFactory;
use Rossel\MwuSdk\Factory\Entity\Message\ClientMessage\ClientMessageFactory;
use Rossel\MwuSdk\Validator\Command\TargetedLightModuleCommandValidator;
use Rossel\MwuSdk\Validator\Command\TargetedSwitchCommandValidator;

class InfrastructureGenerator
{
    /**
     * @throws RandomException
     */
    public static function generateMwuSwitch(): MwuSwitch
    {
        $switchFactory = new MwuSwitchFactory(
            new MwuLightModuleFactory(),
            new ClientMessageFactory(),
            $targetedSwitchCommandValidator = new TargetedSwitchCommandValidator(),
            new TargetedLightModuleCommandValidator($targetedSwitchCommandValidator),
        );

        return $switchFactory->create(
            self::generateSwitchConfig(),
        );
    }

    /**
     * @throws RandomException
     */
    public static function generateSwitchConfig(): SwitchConfig
    {
        return new SwitchConfig(
            RandomDataGenerator::ipv4Address(),
            random_int(SwitchConfig::MIN_PORT_VALUE, SwitchConfig::MAX_PORT_VALUE),
            self::generateLightModulesGeneratorConfig(),
        );
    }

    /**
     * @throws RandomException
     */
    public static function generateLightModulesGeneratorConfig(): LightModulesGeneratorConfig
    {
        return new LightModulesGeneratorConfig(
            random_int(1, 100),
            random_int(1, 100),
            random_int(1, 10),
        );
    }
}
