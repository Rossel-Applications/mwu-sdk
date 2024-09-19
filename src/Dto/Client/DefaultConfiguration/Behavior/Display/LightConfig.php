<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;

final readonly class LightConfig implements LightConfigInterface
{
    public function __construct(
        private LightMode $mode,
        private LightColor $color,
    ) {
    }

    public function getColor(): LightColor
    {
        return $this->color;
    }

    public function getMode(): LightMode
    {
        return $this->mode;
    }
}
