<?php

declare(strict_types=1);

namespace MwuSdk\Model;

use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

/**
 * Interface for the display status of a light module.
 */
interface DisplayStatusInterface
{
    /**
     * Gets the display text.
     *
     * @return string the text to be displayed
     */
    public function getDefaultText(): string;

    /**
     * Sets the display text.
     *
     * @param string $defaultText the text to be displayed
     *
     * @return self returns the instance for method chaining
     */
    public function setDefaultText(string $defaultText): self;

    /**
     * Gets the light color.
     *
     * @return LightColor the current light color
     */
    public function getLightColor(): LightColor;

    /**
     * Sets the light color.
     *
     * @param LightColor $lightColor the light color to set
     *
     * @return self returns the instance for method chaining
     */
    public function setLightColor(LightColor $lightColor): self;

    /**
     * Gets the screen display mode.
     *
     * @return ScreenDisplayMode the current screen display mode
     */
    public function getScreenDisplayMode(): ScreenDisplayMode;

    /**
     * Sets the screen display mode.
     *
     * @param ScreenDisplayMode $screenDisplayMode the screen display mode to set
     *
     * @return self returns the instance for method chaining
     */
    public function setScreenDisplayMode(ScreenDisplayMode $screenDisplayMode): self;

    /**
     * Gets the light mode.
     *
     * @return LightMode the current light mode
     */
    public function getLightMode(): LightMode;

    /**
     * Sets the light mode.
     *
     * @param LightMode $lightMode the light mode to set
     *
     * @return self returns the instance for method chaining
     */
    public function setLightMode(LightMode $lightMode): self;
}
