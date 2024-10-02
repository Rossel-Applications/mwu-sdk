<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior;

use MwuSdk\Model\ConfirmButton;
use MwuSdk\Model\ConfirmButtonInterface;
use MwuSdk\Model\DisplayStatus;
use MwuSdk\Model\DisplayStatusInterface;
use MwuSdk\Model\FnButton;
use MwuSdk\Model\FnButtonInterface;
use MwuSdk\Model\QuantityKeys;
use MwuSdk\Model\QuantityKeysInterface;

final readonly class BehaviorConfig implements BehaviorConfigInterface
{
    private DisplayStatusInterface $displayStatus;

    private DisplayStatusInterface $displayStatusAfterConfirm;

    private DisplayStatusInterface $displayStatusAfterFn;

    private ConfirmButtonInterface $confirmButton;
    private FnButtonInterface $fnButton;
    private QuantityKeysInterface $quantityKeys;

    public function __construct(
        ?DisplayStatusInterface $displayStatus = null,
        ?DisplayStatusInterface $displayStatusAfterConfirm = null,
        ?DisplayStatusInterface $displayStatusAfterFn = null,
        ?ConfirmButtonInterface $confirmButton = null,
        ?FnButtonInterface $fnButton = null,
        ?QuantityKeysInterface $quantityKeys = null,
    ) {
        $this->displayStatus = $displayStatus ?? new DisplayStatus();
        $this->displayStatusAfterConfirm = $displayStatusAfterConfirm ?? new DisplayStatus();
        $this->displayStatusAfterFn = $displayStatusAfterFn ?? new DisplayStatus();
        $this->confirmButton = $confirmButton ?? new ConfirmButton();
        $this->fnButton = $fnButton ?? new FnButton();
        $this->quantityKeys = $quantityKeys ?? new QuantityKeys();
    }

    public function getDisplayStatus(): DisplayStatusInterface
    {
        return $this->displayStatus;
    }

    public function getDisplayStatusAfterConfirm(): DisplayStatusInterface
    {
        return $this->displayStatusAfterConfirm;
    }

    public function getDisplayStatusAfterFn(): DisplayStatusInterface
    {
        return $this->displayStatusAfterFn;
    }

    public function getConfirmButton(): ConfirmButtonInterface
    {
        return $this->confirmButton;
    }

    public function getFnButton(): FnButtonInterface
    {
        return $this->fnButton;
    }

    public function getQuantityKeys(): QuantityKeysInterface
    {
        return $this->quantityKeys;
    }
}
