<?php

declare(strict_types=1);

namespace MwuSdkTest\Serializer\DefaultConfiguration\Content;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfig;
use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ConfirmButtonConfigKeysEnum;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\QuantityKeysConfigKeysEnum;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ButtonsConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\ConfirmButtonConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\FnButtonConfigDenormalizer;
use MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons\QuantityKeysConfigDenormalizer;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ButtonsConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\FnButtonConfigValidator;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigValidator;
use PHPUnit\Framework\TestCase;

class ButtonsConfigDenormalizerTest extends TestCase
{
    private ButtonsConfigDenormalizer $buttonsConfigDenormalizer;

    protected function setUp(): void
    {
        $this->buttonsConfigDenormalizer = new ButtonsConfigDenormalizer(
            new ButtonsConfigValidator(),
            new ConfirmButtonConfigDenormalizer(new ConfirmButtonConfigValidator()),
            new FnButtonConfigDenormalizer(new FnButtonConfigValidator()),
            new QuantityKeysConfigDenormalizer(new QuantityKeysConfigValidator()),
        );
    }

    public function testDenormalize(): void
    {
        $result = $this->buttonsConfigDenormalizer->denormalize(
            [
                ButtonsConfigKeysEnum::KEY_CONFIRM->value => [
                    ConfirmButtonConfigKeysEnum::KEY_ENABLED->value => true,
                ],
                ButtonsConfigKeysEnum::KEY_FN->value => [
                    FnButtonConfigKeysEnum::KEY_ENABLED->value => true,
                    FnButtonConfigKeysEnum::KEY_TEXT->value => '----',
                    FnButtonConfigKeysEnum::KEY_USE_AS_DECREMENT->value => false,
                ],
                ButtonsConfigKeysEnum::KEY_QUANTITY_KEYS->value => [
                    QuantityKeysConfigKeysEnum::KEY_MODE->value => 'off',
                ],
            ]
        );

        $this->assertEquals(
            new ButtonsConfig(
                new ConfirmButtonConfig(true),
                new FnButtonConfig(true, '----', false),
                new QuantityKeysConfig(QuantityKeysMode::OFF),
            ),
            $result,
        );
    }
}
