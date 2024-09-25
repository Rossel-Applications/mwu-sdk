<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\DisplayConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Display\DisplayConfigValidator;

/**
 * Class DisplayConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of display configuration data
 * into a DisplayConfig object. It validates the input data and extracts light and screen
 * configurations using their respective denormalizers.
 */
final readonly class DisplayConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private DisplayConfigValidator $displayConfigValidator,
        private ScreenConfigDenormalizer $screenConfigDenormalizer,
        private LightConfigDenormalizer $lightConfigDenormalizer,
    ) {
    }

    /** {@inheritDoc} */
    public function denormalize(array $data): DisplayConfig
    {
        $this->displayConfigValidator->validate($data);

        /** @var array<array-key, mixed> $normalizedLightConfig */
        $normalizedLightConfig = $data[DisplayConfigKeysEnum::KEY_LIGHT->value];
        /** @var array<array-key, mixed> $normalizedScreenConfig */
        $normalizedScreenConfig = $data[DisplayConfigKeysEnum::KEY_SCREEN->value];

        $lightConfig = $this->lightConfigDenormalizer->denormalize($normalizedLightConfig);
        $screenConfig = $this->screenConfigDenormalizer->denormalize($normalizedScreenConfig);

        return new DisplayConfig($lightConfig, $screenConfig);
    }
}
