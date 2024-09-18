<?php

declare(strict_types=1);

namespace MwuSdk\Model;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

interface DisplayStatusInterface
{
    public function getText(): ?string;

    public function setText(string $text): self;

    public function getLightColor(): ?LightColor;

    public function setLightColor(LightColor $lightColor): self;

    public function getScreenDisplayMode(): ScreenDisplayMode;

    public function setScreenDisplayMode(ScreenDisplayMode $screenDisplayMode): self;

    public function getLightMode(): LightMode;

    public function setLightMode(LightMode $lightMode): self;
}
