<?php

declare(strict_types=1);

namespace MwuSdk\Model;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

final class DisplayStatus implements DisplayStatusInterface
{
    private LightMode $lightMode = LightMode::OFF;
    private ScreenDisplayMode $screenDisplayMode = ScreenDisplayMode::OFF;
    private LightColor $lightColor = LightColor::WHITE;
    private string $text = '';

    public function __construct(
        ?LightMode $lightMode = null,
        ?ScreenDisplayMode $screenDisplayMode = null,
        ?LightColor $lightColor = null,
        ?string $text = null,
    ) {
        if (null !== $lightMode) {
            $this->lightMode = $lightMode;
        }

        if (null !== $screenDisplayMode) {
            $this->screenDisplayMode = $screenDisplayMode;
        }

        if (null !== $lightColor) {
            $this->lightColor = $lightColor;
        }

        if (null !== $text) {
            $this->text = $text;
        }
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getLightColor(): ?LightColor
    {
        return $this->lightColor;
    }

    public function setLightColor(LightColor $lightColor): self
    {
        $this->lightColor = $lightColor;

        return $this;
    }

    public function getScreenDisplayMode(): ScreenDisplayMode
    {
        return $this->screenDisplayMode;
    }

    public function setScreenDisplayMode(ScreenDisplayMode $screenDisplayMode): self
    {
        $this->screenDisplayMode = $screenDisplayMode;

        return $this;
    }

    public function getLightMode(): LightMode
    {
        return $this->lightMode;
    }

    public function setLightMode(LightMode $lightMode): self
    {
        $this->lightMode = $lightMode;

        return $this;
    }
}
