<?php

declare(strict_types=1);

namespace Rossel\MwuSdkTest\Serializer\DefaultConfiguration\Content;

use PHPUnit\Framework\TestCase;
use Random\RandomException;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfig;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\LightModulesGeneratorConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Switches\SwitchesConfigKeysEnum;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Switches\LightModulesGeneratorConfigDenormalizer;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Switches\SwitchesConfigDenormalizer;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Switches\LightModulesGeneratorConfigValidator;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Switches\SwitchesConfigValidator;
use Rossel\MwuSdkTest\Utils\RandomDataGenerator;

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
