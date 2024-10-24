<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\ScreenConfig;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\ScreenConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Display\ScreenConfigValidator;

/**
 * This class is responsible for denormalizing an array of screen configuration data
 * into a ScreenConfig object. It validates the input data and extracts the screen display
 * mode and associated text configuration using the respective enum class.
 */
final readonly class ScreenConfigDenormalizer implements ScreenConfigDenormalizerInterface
{
    public function __construct(
        private ScreenConfigValidator $screenConfigValidator
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): ScreenConfig
    {
        $this->screenConfigValidator->validate($data);

        /** @var string $normalizedModeConfig */
        $normalizedModeConfig = $data[ScreenConfigKeysEnum::KEY_MODE->value];

        /** @var string $textConfig */
        $textConfig = $data[ScreenConfigKeysEnum::KEY_TEXT->value];
        /** @var ScreenDisplayMode $modeConfig */
        $modeConfig = ScreenDisplayMode::findInstanceByStringValue($normalizedModeConfig);

        return new ScreenConfig($modeConfig, $textConfig);
    }
}
