<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display;

use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

interface ScreenConfigInterface
{
    public function getText(): string;

    public function getMode(): ScreenDisplayMode;
}
