<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display;

use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

interface ScreenConfigInterface
{
    public function getText(): string;

    public function getMode(): ScreenDisplayMode;
}
