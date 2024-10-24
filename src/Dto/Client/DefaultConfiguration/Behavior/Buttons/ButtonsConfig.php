<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons;

use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeysInterface;

final readonly class ButtonsConfig implements ButtonsConfigInterface
{
    public function __construct(
        private FnButtonInterface $fn,
        private QuantityKeysInterface $quantityKeys,
    ) {
    }

    public function getFnButton(): FnButtonInterface
    {
        return $this->fn;
    }

    public function getQuantityKeys(): QuantityKeysInterface
    {
        return $this->quantityKeys;
    }
}
