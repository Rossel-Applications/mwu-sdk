<?php

declare(strict_types=1);

namespace MwuSdk\Enum\DefaultConfigurationParameterKeys\Behavior;

enum BehaviorConfigKeysEnum: string
{
    case KEY_DISPLAY_STATUS = 'display_status';
    case KEY_DISPLAY_STATUS_AFTER_CONFIRM = 'display_status_after_confirm';
    case KEY_DISPLAY_STATUS_AFTER_FN = 'display_status_after_fn';
    case KEY_BUTTONS = 'buttons';
}
