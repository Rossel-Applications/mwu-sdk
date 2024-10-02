<?php

declare(strict_types=1);

namespace MwuSdkTest\Serializer\DefaultConfiguration\Content;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\DisplayConfigKeysEnum;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\LightConfigKeysEnum;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\ScreenConfigKeysEnum;
use MwuSdk\Model\DisplayStatus;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\DisplayConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\LightConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display\ScreenConfigDenormalizer;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\DisplayConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\LightConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\ScreenConfigValidator;
use PHPUnit\Framework\TestCase;

class DisplayConfigDenormalizerTest extends TestCase
{
    private DisplayConfigDenormalizer $displayConfigDenormalizer;

    protected function setUp(): void
    {
        $this->displayConfigDenormalizer = new DisplayConfigDenormalizer(
            new DisplayConfigValidator(),
            new ScreenConfigDenormalizer(new ScreenConfigValidator()),
            new LightConfigDenormalizer(new LightConfigValidator()),
        );
    }

    public function testDenormalize(): void
    {
        $result = $this->displayConfigDenormalizer->denormalize(
            [
                DisplayConfigKeysEnum::KEY_LIGHT->value => [
                    LightConfigKeysEnum::KEY_MODE->value => LightMode::ON->value,
                    LightConfigKeysEnum::KEY_COLOR->value => LightColor::GREEN->value,
                ],
                DisplayConfigKeysEnum::KEY_SCREEN->value => [
                    ScreenConfigKeysEnum::KEY_MODE->value => ScreenDisplayMode::ON->value,
                    ScreenConfigKeysEnum::KEY_TEXT->value => '9999',
                ],
            ]
        );

        $this->assertEquals(
            new DisplayStatus(
                LightMode::ON,
                ScreenDisplayMode::ON,
                LightColor::GREEN,
                '9999',
            ),
            $result,
        );
    }
}
