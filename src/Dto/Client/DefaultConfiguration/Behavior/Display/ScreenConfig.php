<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\Display;

use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

final readonly class ScreenConfig implements ScreenConfigInterface
{
    public function __construct(
        private ScreenDisplayMode $mode,
        private string $text,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getMode(): ScreenDisplayMode
    {
        return $this->mode;
    }
}
