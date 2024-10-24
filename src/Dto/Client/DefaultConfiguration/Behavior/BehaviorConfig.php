<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior;

use Rossel\MwuSdk\Model\DisplayStatus;
use Rossel\MwuSdk\Model\DisplayStatusInterface;
use Rossel\MwuSdk\Model\FnButton;
use Rossel\MwuSdk\Model\FnButtonInterface;
use Rossel\MwuSdk\Model\QuantityKeys;
use Rossel\MwuSdk\Model\QuantityKeysInterface;

final readonly class BehaviorConfig implements BehaviorConfigInterface
{
    private DisplayStatusInterface $displayStatus;

    private DisplayStatusInterface $displayStatusAfterConfirm;

    private DisplayStatusInterface $displayStatusAfterFn;
    private FnButtonInterface $fnButton;
    private QuantityKeysInterface $quantityKeys;

    public function __construct(
        ?DisplayStatusInterface $displayStatus = null,
        ?DisplayStatusInterface $displayStatusAfterConfirm = null,
        ?DisplayStatusInterface $displayStatusAfterFn = null,
        ?FnButtonInterface $fnButton = null,
        ?QuantityKeysInterface $quantityKeys = null,
    ) {
        $this->displayStatus = $displayStatus ?? new DisplayStatus();
        $this->displayStatusAfterConfirm = $displayStatusAfterConfirm ?? new DisplayStatus();
        $this->displayStatusAfterFn = $displayStatusAfterFn ?? new DisplayStatus();
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

    public function getFnButton(): FnButtonInterface
    {
        return $this->fnButton;
    }

    public function getQuantityKeys(): QuantityKeysInterface
    {
        return $this->quantityKeys;
    }
}
