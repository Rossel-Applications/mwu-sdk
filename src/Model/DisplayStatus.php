<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Model;

use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

/**
 * Class representing the display status of a light module.
 */
final class DisplayStatus implements DisplayStatusInterface
{
    private const DEFAULT_LIGHT_MODE = LightMode::ON;
    private const DEFAULT_SCREEN_DISPLAY_MODE = ScreenDisplayMode::ON;
    private const DEFAULT_LIGHT_COLOR = LightColor::WHITE;

    private LightMode $lightMode = self::DEFAULT_LIGHT_MODE;
    private ScreenDisplayMode $screenDisplayMode = self::DEFAULT_SCREEN_DISPLAY_MODE;
    private LightColor $lightColor = self::DEFAULT_LIGHT_COLOR;
    private string $defaultText = '----';

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
            $this->defaultText = $text;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultText(): string
    {
        return $this->defaultText;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultText(string $defaultText): self
    {
        $this->defaultText = $defaultText;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLightColor(): LightColor
    {
        return $this->lightColor;
    }

    /**
     * {@inheritDoc}
     */
    public function setLightColor(LightColor $lightColor): self
    {
        $this->lightColor = $lightColor;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getScreenDisplayMode(): ScreenDisplayMode
    {
        return $this->screenDisplayMode;
    }

    /**
     * {@inheritDoc}
     */
    public function setScreenDisplayMode(ScreenDisplayMode $screenDisplayMode): self
    {
        $this->screenDisplayMode = $screenDisplayMode;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLightMode(): LightMode
    {
        return $this->lightMode;
    }

    /**
     * {@inheritDoc}
     */
    public function setLightMode(LightMode $lightMode): self
    {
        $this->lightMode = $lightMode;

        return $this;
    }
}
