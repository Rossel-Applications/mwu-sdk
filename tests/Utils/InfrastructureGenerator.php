<?php

declare(strict_types=1);

namespace MwuSdkTest\Utils;

use MwuSdk\Client\MwuSwitch;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use MwuSdk\Factory\Client\MwuLightModuleFactory;
use MwuSdk\Factory\Client\MwuSwitchFactory;
use MwuSdk\Validator\Command\TargetedLightModuleCommandValidator;
use MwuSdk\Validator\Command\TargetedSwitchCommandValidator;
use Random\RandomException;

class InfrastructureGenerator
{
    /**
     * @throws RandomException
     */
    public static function generateMwuSwitch(): MwuSwitch
    {
        $switchFactory = new MwuSwitchFactory(
            new MwuLightModuleFactory(),
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
