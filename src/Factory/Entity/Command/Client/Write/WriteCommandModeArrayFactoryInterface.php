<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Entity\Command\Client\Write;

use Rossel\MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use Rossel\MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandModeArrayInterface;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use Rossel\MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;

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
        ?LightColor $lightColorAfterConfirm = null,
        ?LightMode $lightModeAfterConfirm = null,
        ?ScreenDisplayMode $screenDisplayModeAfterConfirm = null,
        ?LightColor $lightColorAfterFn = null,
        ?LightMode $lightModeAfterFn = null,
        ?ScreenDisplayMode $screenDisplayModeAfterFn = null,
        ?QuantityKeysMode $quantityKeysMode = null,
    ): WriteCommandModeArrayInterface;
}
