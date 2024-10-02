<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfig;
use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\QuantityKeysConfigKeysEnum;
use MwuSdk\Model\QuantityKeys;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\QuantityKeysConfigValidator;

/**
 * Class QuantityKeysConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of quantity keys configuration data
 * into a QuantityKeysConfig object. It validates the input data to ensure it conforms
 * to the expected structure and values, particularly for the quantity keys mode.
 */
final readonly class QuantityKeysConfigDenormalizer implements QuantityKeysConfigDenormalizerInterface
{
    public function __construct(
        private QuantityKeysConfigValidator $quantityKeysConfigValidator,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): QuantityKeys
    {
        $this->quantityKeysConfigValidator->validate($data);

        /** @var string $normalizedMode */
        $normalizedMode = $data[QuantityKeysConfigKeysEnum::KEY_MODE->value];
        /** @var QuantityKeysMode $mode */
        $mode = QuantityKeysMode::findInstanceByStringValue($normalizedMode);

        $enabled = QuantityKeysMode::OFF !== $mode;

        return new QuantityKeys($enabled, $mode);
    }
}
