<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Dto\Command\Write;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandModeArray;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use MwuSdk\Utils\EncodingConverter;

/**
 * Factory for creating WriteCommandModeArray instances.
 */
final readonly class WriteCommandModeArrayFactory implements WriteCommandModeArrayFactoryInterface
{
    private const M1_STATIC_PREFIX = 'm1';
    private const M1_VALUES_STATIC_PREFIX = '0011';

    private const BUZZER_MODE_OFF = 0b0001;

    /**
     * {@inheritDoc}
     *
     * @return WriteCommandModeArray the constructed command mode array
     */
    public function create(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColor = null,
        ?LightMode $lightMode = null,
        ?ScreenDisplayMode $screenDisplayMode = null,
    ): WriteCommandModeArray {
        $lightColor = $lightColor ?? $lightModule->getDisplayStatus()->getLightColor();
        $lightMode = $lightMode ?? $lightModule->getDisplayStatus()->getLightMode();
        $screenDisplayMode = $screenDisplayMode ?? $lightModule->getDisplayStatus()->getScreenDisplayMode();

        return new WriteCommandModeArray(
            $this->buildM1Section($lightColor, $lightMode, $screenDisplayMode),
            $this->buildM2Section($lightModule, $lightColor, $lightMode, $screenDisplayMode),
            $this->buildM3Section($lightModule, $lightColor, $lightMode, $screenDisplayMode),
        );
    }

    /**
     * Builds the M1 section of the command mode array.
     *
     * @param LightColor        $lightColor        the light color to use; defaults to the module's current color if not provided
     * @param LightMode         $lightMode         the light mode to use; defaults to the module's current mode if not provided
     * @param ScreenDisplayMode $screenDisplayMode the screen display mode to use; defaults to the module's current mode if not provided
     *
     * @return string the M1 section as a string
     */
    private function buildM1Section(
        LightColor $lightColor,
        LightMode $lightMode,
        ScreenDisplayMode $screenDisplayMode,
    ): string {
        // A binary string representing 20 bits
        $modeArrayBinValues = sprintf(
            '%s%012b%04b%04b',
            self::M1_VALUES_STATIC_PREFIX,
            $lightColor->getBinaryValueWithMode($lightMode),
            $screenDisplayMode->getBinaryValue(),
            self::BUZZER_MODE_OFF,
        );

        $modeArrayAsciiValues = EncodingConverter::binaryToAscii($modeArrayBinValues);

        return self::M1_STATIC_PREFIX.$modeArrayAsciiValues;
    }

    /**
     * Builds the M2 section of the command mode array.
     *
     * @param MwuLightModuleInterface $lightModule       the light module to use for retrieving status
     * @param LightColor|null         $lightColor        the light color to use; defaults to the module's current color if not provided
     * @param LightMode|null          $lightMode         the light mode to use; defaults to the module's current mode if not provided
     * @param ScreenDisplayMode|null  $screenDisplayMode the screen display mode to use; defaults to the module's current mode if not provided
     *
     * @return string the M2 section as a string (currently returns an empty string)
     */
    private function buildM2Section(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColor = null,
        ?LightMode $lightMode = null,
        ?ScreenDisplayMode $screenDisplayMode = null,
    ): string {
        return '';
    }

    /**
     * Builds the M3 section of the command mode array.
     *
     * @param MwuLightModuleInterface $lightModule       the light module to use for retrieving status
     * @param LightColor|null         $lightColor        the light color to use; defaults to the module's current color if not provided
     * @param LightMode|null          $lightMode         the light mode to use; defaults to the module's current mode if not provided
     * @param ScreenDisplayMode|null  $screenDisplayMode the screen display mode to use; defaults to the module's current mode if not provided
     *
     * @return string the M3 section as a string (currently returns an empty string)
     */
    private function buildM3Section(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColor = null,
        ?LightMode $lightMode = null,
        ?ScreenDisplayMode $screenDisplayMode = null,
    ): string {
        return '';
    }
}
