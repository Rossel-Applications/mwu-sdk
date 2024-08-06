<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Buttons\ButtonsConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display\DisplayConfigInterface;

final readonly class BehaviorConfig implements BehaviorConfigInterface
{
    private DisplayConfigInterface $displayStatus;

    private DisplayConfigInterface $displayStatusAfterConfirm;

    private DisplayConfigInterface $displayStatusAfterFn;

    private ButtonsConfigInterface $buttons;

    public function __construct(
        DisplayConfigInterface $displayStatus,
        DisplayConfigInterface $displayStatusAfterConfirm,
        DisplayConfigInterface $displayStatusAfterFn,
        ButtonsConfigInterface $buttons,
    ) {
        $this->displayStatus = $displayStatus;
        $this->displayStatusAfterConfirm = $displayStatusAfterConfirm;
        $this->displayStatusAfterFn = $displayStatusAfterFn;
        $this->buttons = $buttons;
    }

    public function getDisplayStatus(): DisplayConfigInterface
    {
        return $this->displayStatus;
    }

    public function getDisplayStatusAfterConfirm(): DisplayConfigInterface
    {
        return $this->displayStatusAfterConfirm;
    }

    public function getDisplayStatusAfterFn(): DisplayConfigInterface
    {
        return $this->displayStatusAfterFn;
    }

    public function getButtons(): ButtonsConfigInterface
    {
        return $this->buttons;
    }
}
