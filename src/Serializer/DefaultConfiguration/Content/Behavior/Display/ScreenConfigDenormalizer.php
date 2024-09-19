<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\ScreenConfig;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\ScreenConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\ScreenConfigValidator;

final readonly class ScreenConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private ScreenConfigValidator $screenConfigValidator
    ) {
    }

    /** {@inheritDoc} */
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
