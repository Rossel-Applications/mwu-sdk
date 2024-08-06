<?php

declare(strict_types=1);

namespace MwuSdkTest\Serializer\DefaultConfiguration\Content;

use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\LightModulesGeneratorConfigKeysEnum;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use MwuSdk\Serializer\DefaultConfiguration\Content\Switches\LightModulesGeneratorConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Switches\SwitchesConfigDenormalizer;
use MwuSdk\Validator\DefaultConfiguration\Switches\LightModulesGeneratorConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Switches\SwitchesConfigValidator;
use MwuSdkTest\Utils\RandomDataGenerator;
use PHPUnit\Framework\TestCase;
use Random\RandomException;

class SwitchesConfigDenormalizerTest extends TestCase
{
    private SwitchesConfigDenormalizer $switchesConfigDenormalizer;

    protected function setUp(): void
    {
        $this->switchesConfigDenormalizer = new SwitchesConfigDenormalizer(
            new SwitchesConfigValidator(),
            new LightModulesGeneratorConfigDenormalizer(new LightModulesGeneratorConfigValidator()),
        );
    }

    /**
     * @throws RandomException
     */
    public function testDenormalize(): void
    {
        $ipAddress = RandomDataGenerator::ipv4Address();
        $port = 9100;

        $firstLightModuleId = 1;
        $numberOfLightModules = 10;
        $incrementBetweenLightModuleIds = 1;

        $result = $this->switchesConfigDenormalizer->denormalize(
            [
                [
                    SwitchesConfigKeysEnum::ITEM_KEY_IP_ADDRESS->value => $ipAddress,
                    SwitchesConfigKeysEnum::ITEM_KEY_IP_PORT->value => $port,
                    SwitchesConfigKeysEnum::ITEM_KEY_LIGHT_MODULES_GENERATOR->value => [
                        LightModulesGeneratorConfigKeysEnum::KEY_FIRST_MODULE_ID->value => $firstLightModuleId,
                        LightModulesGeneratorConfigKeysEnum::KEY_NUMBER_OF_MODULES->value => $numberOfLightModules,
                        LightModulesGeneratorConfigKeysEnum::KEY_INCREMENT_BETWEEN_MODULE_IDS->value => $incrementBetweenLightModuleIds,
                    ],
                ],
            ]
        );

        $this->assertEquals(
            [
                new SwitchConfig(
                    $ipAddress,
                    $port,
                    new LightModulesGeneratorConfig(
                        $firstLightModuleId,
                        $numberOfLightModules,
                        $incrementBetweenLightModuleIds
                    ),
                ),
            ],
            $result,
        );
    }
}
