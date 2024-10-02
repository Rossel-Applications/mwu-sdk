<?php

declare(strict_types=1);

namespace MwuSdk\Serializer\DefaultConfiguration\Content\Behavior\Buttons;

use MwuSdk\Model\ConfirmButtonInterface;
use MwuSdk\Serializer\DenormalizerInterface;

interface ConfirmButtonConfigDenormalizerInterface extends DenormalizerInterface
{
    /**
     * {@inheritDoc}
     */
    public function denormalize(array $data): ConfirmButtonInterface;
}
