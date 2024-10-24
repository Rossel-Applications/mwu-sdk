<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Builder\Command\Write;

use Rossel\MwuSdk\Builder\Command\TargetedLightModuleCommandBuilderInterface;
use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandInterface;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

/**
 * This interface defines methods to be implemented by write command builders.
 */
interface WriteCommandBuilderInterface extends TargetedLightModuleCommandBuilderInterface
{
    /**
     * Specify data to display after pressing the Fn key.
     *
     * @param ?string $data data to display after pressing the Fn key, or null if no data is to be displayed
     */
    public function withFnData(?string $data): self;

    /**
     * Specify the light color for the "confirm" button.
     *
     * @param ?LightColor $color the light color for the "confirm" button, or null to use the default configured value
     */
    public function withLightColor(?LightColor $color): self;

    /**
     * Specify the light mode for the "confirm" button.
     *
     * @param ?LightMode $mode the light mode for the "confirm" button, or null to use the default mode
     */
    public function withLightMode(?LightMode $mode): self;

    /**
     * Specify the screen display mode.
     *
     * @param ?ScreenDisplayMode $mode the screen display mode, or null to use the default mode
     */
    public function withScreenDisplayMode(?ScreenDisplayMode $mode): self;

    /**
     * Specify the light color for the "confirm" button after pressing it.
     *
     * @param ?LightColor $color the light color for the "confirm" button, or null to use the default configured value
     */
    public function withLightColorAfterConfirm(?LightColor $color): self;

    /**
     * Specify the light mode for the "confirm" button after pressing it.
     *
     * @param ?LightMode $mode the light mode for the "confirm" button, or null to use the default mode
     */
    public function withLightModeAfterConfirm(?LightMode $mode): self;

    /**
     * Specify the screen display mode after pressing the "confirm" button.
     *
     * @param ?ScreenDisplayMode $mode the screen display mode, or null to use the default mode
     */
    public function withScreenDisplayModeAfterConfirm(?ScreenDisplayMode $mode): self;

    /**
     * Specify the light color for the "confirm" button after pressing the "fn" key.
     *
     * @param ?LightColor $color the light color for the "confirm" button, or null to use the default configured value
     */
    public function withLightColorAfterFn(?LightColor $color): self;

    /**
     * Specify the light mode for the "confirm" button after pressing the "fn" key.
     *
     * @param ?LightMode $mode the light mode for the "confirm" button, or null to use the default mode
     */
    public function withLightModeAfterFn(?LightMode $mode): self;

    /**
     * Specify the screen display mode after pressing the "fn" key.
     *
     * @param ?ScreenDisplayMode $mode the screen display mode, or null to use the default mode
     */
    public function withScreenDisplayModeAfterFn(?ScreenDisplayMode $mode): self;

    /**
     * Specify the quantity keys increment mode.
     *
     * @param QuantityKeysMode|null $mode the quantity keys increment mode
     */
    public function withQuantityKeysMode(?QuantityKeysMode $mode): self;

    /**
     * Get the data to be displayed after pressing the Fn key.
     *
     * @return ?string the data to be displayed, or null if not specified
     */
    public function getFnData(): ?string;

    /**
     * Get the light color for the "confirm" button.
     *
     * @return ?LightColor the light color, or null if not specified
     */
    public function getLightColor(): ?LightColor;

    /**
     * Get the light mode for the "confirm" button.
     *
     * @return ?LightMode the light mode, or null if not specified
     */
    public function getLightMode(): ?LightMode;

    /**
     * Get the screen display mode.
     *
     * @return ?ScreenDisplayMode the screen display mode, or null if not specified
     */
    public function getScreenDisplayMode(): ?ScreenDisplayMode;

    /**
     * Get the light color for the "confirm" button after pressing it.
     *
     * @return ?LightColor the light color, or null if not specified
     */
    public function getLightColorAfterConfirm(): ?LightColor;

    /**
     * Get the light mode for the "confirm" button after pressing it.
     *
     * @return ?LightMode the light mode, or null if not specified
     */
    public function getLightModeAfterConfirm(): ?LightMode;

    /**
     * Get the screen display mode after pressing the "confirm" button.
     *
     * @return ?ScreenDisplayMode the screen display mode, or null if not specified
     */
    public function getScreenDisplayModeAfterConfirm(): ?ScreenDisplayMode;

    /**
     * Get the light color for the "confirm" button after pressing the "fn" key.
     *
     * @return ?LightColor the light color, or null if not specified
     */
    public function getLightColorAfterFn(): ?LightColor;

    /**
     * Get the light mode for the "confirm" button after pressing the "fn" key.
     *
     * @return ?LightMode the light mode, or null if not specified
     */
    public function getLightModeAfterFn(): ?LightMode;

    /**
     * Get the screen display mode after pressing the "fn" key.
     *
     * @return ?ScreenDisplayMode the screen display mode, or null if not specified
     */
    public function getScreenDisplayModeAfterFn(): ?ScreenDisplayMode;

    /**
     * Get the quantity keys increment mode.
     *
     * @return QuantityKeysMode|null the quantity keys increment mode
     */
    public function getQuantityKeysMode(): ?QuantityKeysMode;

    /**
     * Generate the write command for the specified light module.
     *
     * @param MwuLightModuleInterface $lightModule the light module to which the command will be sent
     * @param ?string                 $text        the text to be displayed on the screen, or null if no text is to be displayed
     *
     * @return WriteCommandInterface the generated command
     */
    public function buildCommand(MwuLightModuleInterface $lightModule, ?string $text = null): WriteCommandInterface;

    /**
     * Generate write commands to the specified light modules.
     *
     * @param ?string                                   $text         optional text to be displayed on the screens of the light modules, or null if no text is to be displayed
     * @param array<array-key, MwuLightModuleInterface> $lightModules an array of light modules to which the commands will be sent
     * @param list<\Exception>                          $errors       reference to capture errors
     *
     * @return array<int, WriteCommandInterface> an array of generated write commands
     */
    public function buildCommands(array $lightModules, ?string $text = null, array &$errors = []): array;
}
