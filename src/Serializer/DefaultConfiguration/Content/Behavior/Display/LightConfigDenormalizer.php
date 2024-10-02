<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\LightConfig;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\LightConfigKeysEnum;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\LightConfigValidator;

/**
 * Class LightConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of light configuration data
 * into a LightConfig object. It validates the input data and extracts light color
 * and light mode configurations using the respective enum classes.
 */
final readonly class LightConfigDenormalizer implements LightConfigDenormalizerInterface
{
    public function __construct(
        private LightConfigValidator $lightConfigValidator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): LightConfig
    {
        $this->lightConfigValidator->validate($data);

        /** @var string $normalizedColorConfig */
        $normalizedColorConfig = $data[LightConfigKeysEnum::KEY_COLOR->value];
        /** @var string $normalizedModeConfig */
        $normalizedModeConfig = $data[LightConfigKeysEnum::KEY_MODE->value];

        /** @var LightColor $lightColorConfig */
        $lightColorConfig = LightColor::findInstanceByStringValue($normalizedColorConfig);
        /** @var LightMode $lightModeConfig */
        $lightModeConfig = LightMode::findInstanceByStringValue($normalizedModeConfig);

        return new LightConfig($lightModeConfig, $lightColorConfig);
    }
}
