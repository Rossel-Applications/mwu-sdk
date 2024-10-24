<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\FnButtonConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\FnButtonConfigKeysEnum;
use MwuSdk\Model\FnButton;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\FnButtonConfigValidator;

/**
 * Class FnButtonConfigDenormalizer.
 *
 * This class is responsible for denormalizing an array of function button configuration data
 * into a FnButtonConfig object. It validates the input data to ensure it adheres
 * to the expected structure and format.
 */
final readonly class FnButtonConfigDenormalizer implements FnButtonConfigDenormalizerInterface
{
    public function __construct(
        private FnButtonConfigValidator $fnButtonConfigValidator,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): FnButton
    {
        $this->fnButtonConfigValidator->validate($data);

        /** @var string $text */
        $text = $data[FnButtonConfigKeysEnum::KEY_TEXT->value];

        return new FnButton($text);
    }
}
