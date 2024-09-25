<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\FnButtonConfigValidator;

/**
 * Class FnButtonConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of function button configuration data
 * into a FnButtonConfig object. It validates the input data to ensure it adheres
 * to the expected structure and format.
 */
final readonly class FnButtonConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private FnButtonConfigValidator $fnButtonConfigValidator,
    ) {
    }

    /** {@inheritDoc} */
    public function denormalize(array $data): FnButtonConfig
    {
        $this->fnButtonConfigValidator->validate($data);

        /** @var bool $enabled */
        $enabled = $data[FnButtonConfigKeysEnum::KEY_ENABLED->value];
        /** @var string $text */
        $text = $data[FnButtonConfigKeysEnum::KEY_TEXT->value];
        /** @var bool $useAsDecrement */
        $useAsDecrement = $data[FnButtonConfigKeysEnum::KEY_USE_AS_DECREMENT->value];

        return new FnButtonConfig($enabled, $text, $useAsDecrement);
    }
}
