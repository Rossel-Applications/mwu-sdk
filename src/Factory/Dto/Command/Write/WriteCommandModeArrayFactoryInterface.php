<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Dto\Command\Write;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandModeArrayInterface;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

/**
 * Interface for creating WriteCommandModeArray instances.
 */
interface WriteCommandModeArrayFactoryInterface
{
    /**
     * Creates a WriteCommandModeArray based on the specified parameters.
     *
     * @param MwuLightModuleInterface $lightModule       the light module for which the command mode array is created
     * @param LightColor|null         $lightColor        the light color to use; defaults to null if not provided
     * @param LightMode|null          $lightMode         the light mode to use; defaults to null if not provided
     * @param ScreenDisplayMode|null  $screenDisplayMode the screen display mode to use; defaults to null if not provided
     *
     * @return WriteCommandModeArrayInterface the constructed command mode array
     */
    public function create(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColor = null,
        ?LightMode $lightMode = null,
        ?ScreenDisplayMode $screenDisplayMode = null,
    ): WriteCommandModeArrayInterface;
}
