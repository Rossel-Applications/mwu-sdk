<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfig;
use MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior\Buttons\ConfirmButtonConfigKeysEnum;
use MwuSdk\Serializer\DenormalizerInterface;
use MwuSdk\Validator\DefaultConfiguration\Behavior\Buttons\ConfirmButtonConfigValidator;

final readonly class ConfirmButtonConfigDenormalizer implements DenormalizerInterface
{
    public function __construct(
        private ConfirmButtonConfigValidator $confirmButtonConfigValidator,
    ) {
    }

    /** {@inheritDoc} */
    public function denormalize(array $data): ConfirmButtonConfig
    {
        $this->confirmButtonConfigValidator->validate($data);

        /** @var bool $enabled */
        $enabled = $data[ConfirmButtonConfigKeysEnum::KEY_ENABLED->value];

        return new ConfirmButtonConfig($enabled);
    }
}
