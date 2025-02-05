<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Display;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfig;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Display\DisplayConfigKeysEnum;
use Rossel\MwuSdk\Model\DisplayStatus;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Display\DisplayConfigValidator;

/**
 * Class DisplayConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of display configuration data
 * into a DisplayConfig object. It validates the input data and extracts light and screen
 * configurations using their respective denormalizers.
 */
final readonly class DisplayConfigDenormalizer implements DisplayConfigDenormalizerInterface
{
    public function __construct(
        private DisplayConfigValidator $displayConfigValidator,
        private ScreenConfigDenormalizer $screenConfigDenormalizer,
        private LightConfigDenormalizer $lightConfigDenormalizer,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): DisplayStatus
    {
        $this->displayConfigValidator->validate($data);

        /** @var array<array-key, mixed> $normalizedLightConfig */
        $normalizedLightConfig = $data[DisplayConfigKeysEnum::KEY_LIGHT->value];
        /** @var array<array-key, mixed> $normalizedScreenConfig */
        $normalizedScreenConfig = $data[DisplayConfigKeysEnum::KEY_SCREEN->value];

        $lightConfig = $this->lightConfigDenormalizer->denormalize($normalizedLightConfig);
        $screenConfig = $this->screenConfigDenormalizer->denormalize($normalizedScreenConfig);

        return new DisplayStatus(
            $lightConfig->getMode(),
            $screenConfig->getMode(),
            $lightConfig->getColor(),
            $screenConfig->getText(),
        );
    }
}
