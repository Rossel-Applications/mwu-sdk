<?php

declare(strict_types=1);

namespace Rossel\MwuSdkTest\Serializer\DefaultConfiguration\Content;

use PHPUnit\Framework\TestCase;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfig;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\QuantityKeysConfigKeysEnum;
use Rossel\MwuSdk\Model\FnButton;
use Rossel\MwuSdk\Model\QuantityKeys;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ButtonsConfigDenormalizer;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\FnButtonConfigDenormalizer;
use Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\QuantityKeysConfigDenormalizer;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ButtonsConfigValidator;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\FnButtonConfigValidator;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigValidator;

class ButtonsConfigDenormalizerTest extends TestCase
{
    private ButtonsConfigDenormalizer $buttonsConfigDenormalizer;

    protected function setUp(): void
    {
        $this->buttonsConfigDenormalizer = new ButtonsConfigDenormalizer(
            new ButtonsConfigValidator(),
            new FnButtonConfigDenormalizer(new FnButtonConfigValidator()),
            new QuantityKeysConfigDenormalizer(new QuantityKeysConfigValidator()),
        );
    }

    public function testDenormalize(): void
    {
        $result = $this->buttonsConfigDenormalizer->denormalize(
            [
                ButtonsConfigKeysEnum::KEY_FN->value => [
                    FnButtonConfigKeysEnum::KEY_TEXT->value => '----',
                ],
                ButtonsConfigKeysEnum::KEY_QUANTITY_KEYS->value => [
                    QuantityKeysConfigKeysEnum::KEY_MODE->value => 'off',
                ],
            ]
        );

        $this->assertEquals(
            new ButtonsConfig(
                new FnButton('----'),
                new QuantityKeys(false, QuantityKeysMode::OFF),
            ),
            $result,
        );
    }
}
