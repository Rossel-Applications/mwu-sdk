<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfig;
use Rossel\MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ButtonsConfigKeysEnum;
use Rossel\MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ButtonsConfigValidator;

/**
 * Class ButtonsConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of button configuration data
 * into a ButtonsConfig object. It utilizes various denormalizers for specific button
 * configurations and validates the data before processing.
 */
final readonly class ButtonsConfigDenormalizer implements ButtonsConfigDenormalizerInterface
{
    public function __construct(
        private ButtonsConfigValidator $buttonsConfigValidator,
        private FnButtonConfigDenormalizer $fnButtonConfigDenormalizer,
        private QuantityKeysConfigDenormalizer $quantityKeysConfigDenormalizer,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): ButtonsConfig
    {
        $this->buttonsConfigValidator->validate($data);

        /** @var array<array-key, mixed> $normalizedFnButtonConfig */
        $normalizedFnButtonConfig = $data[ButtonsConfigKeysEnum::KEY_FN->value];
        $fnButtonConfig = $this->fnButtonConfigDenormalizer->denormalize($normalizedFnButtonConfig);

        /** @var array<array-key, mixed> $normalizedQuantityKeysConfig */
        $normalizedQuantityKeysConfig = $data[ButtonsConfigKeysEnum::KEY_QUANTITY_KEYS->value];
        $quantityKeysConfig = $this->quantityKeysConfigDenormalizer->denormalize($normalizedQuantityKeysConfig);

        return new ButtonsConfig($fnButtonConfig, $quantityKeysConfig);
    }
}
