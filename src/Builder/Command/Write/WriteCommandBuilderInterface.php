<?php

declare(strict_types=1);

namespace MwuSdk\Builder\Command\Write;

use MwuSdk\Builder\Command\TargetedLightModuleCommandBuilderInterface;
use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandInterface;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

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
     * @param ?ScreenDisplayMode $screenDisplayMode the screen display mode, or null to use the default mode
     */
    public function withScreenDisplayMode(?ScreenDisplayMode $screenDisplayMode): self;

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
