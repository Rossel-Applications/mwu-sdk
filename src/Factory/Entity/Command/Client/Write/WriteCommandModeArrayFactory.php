<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Entity\Command\Client\Write;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandModeArray;
use MwuSdk\Enum\ConfigurationParameterValues\Buttons\QuantityKeysMode;
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
    private const M2_STATIC_PREFIX = 'm2';
    private const M3_STATIC_PREFIX = 'm3';
    private const MA_STATIC_PREFIX = 'ma';
    private const VALUES_STATIC_PREFIX = '0011';
    private const BUZZER_MODE_OFF = 0b0001;

    /**
     * Creates a WriteCommandModeArray based on the light module and optional display settings.
     *
     * @param MwuLightModuleInterface $lightModule                   the light module to retrieve display statuses from
     * @param LightColor|null         $lightColor                    the light color for M1 (optional)
     * @param LightMode|null          $lightMode                     the light mode for M1 (optional)
     * @param ScreenDisplayMode|null  $screenDisplayMode             the screen display mode for M1 (optional)
     * @param LightColor|null         $lightColorAfterConfirm        the light color for M2 after confirmation (optional)
     * @param LightMode|null          $lightModeAfterConfirm         the light mode for M2 after confirmation (optional)
     * @param ScreenDisplayMode|null  $screenDisplayModeAfterConfirm the screen display mode for M2 after confirmation (optional)
     * @param LightColor|null         $lightColorAfterFn             the light color for M3 after function key (optional)
     * @param LightMode|null          $lightModeAfterFn              the light mode for M3 after function key (optional)
     * @param ScreenDisplayMode|null  $screenDisplayModeAfterFn      the screen display mode for M3 after function key (optional)
     *
     * @return WriteCommandModeArray the constructed command mode array
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
    ): WriteCommandModeArray {
        return new WriteCommandModeArray(
            self::M1_STATIC_PREFIX.$this->createM1Value($lightModule, $lightColor, $lightMode, $screenDisplayMode),
            self::M2_STATIC_PREFIX.$this->createM2Value($lightModule, $lightColorAfterConfirm, $lightModeAfterConfirm, $screenDisplayModeAfterConfirm),
            self::M3_STATIC_PREFIX.$this->createM3Value($lightModule, $lightColorAfterFn, $lightModeAfterFn, $screenDisplayModeAfterFn),
            self::MA_STATIC_PREFIX.$this->createMaValue($lightModule, $quantityKeysMode),
        );
    }

    /**
     * Builds the M1 value based on the light module's display status or provided parameters.
     *
     * @param MwuLightModuleInterface $lightModule       the light module to retrieve display statuses from
     * @param LightColor|null         $lightColor        the light color for M1 (optional)
     * @param LightMode|null          $lightMode         the light mode for M1 (optional)
     * @param ScreenDisplayMode|null  $screenDisplayMode the screen display mode for M1 (optional)
     *
     * @return string the constructed M1 value
     */
    private function createM1Value(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColor,
        ?LightMode $lightMode,
        ?ScreenDisplayMode $screenDisplayMode
    ): string {
        $lightColor = $lightColor ?? $lightModule->getDisplayStatus()->getLightColor();
        $lightMode = $lightMode ?? $lightModule->getDisplayStatus()->getLightMode();
        $screenDisplayMode = $screenDisplayMode ?? $lightModule->getDisplayStatus()->getScreenDisplayMode();

        return $this->createDisplayModeArrayValue($lightColor, $lightMode, $screenDisplayMode);
    }

    /**
     * Builds the M2 value based on the light module's display status after confirmation or provided parameters.
     *
     * @param MwuLightModuleInterface $lightModule                   the light module to retrieve display statuses from
     * @param LightColor|null         $lightColorAfterConfirm        the light color for M2 after confirmation (optional)
     * @param LightMode|null          $lightModeAfterConfirm         the light mode for M2 after confirmation (optional)
     * @param ScreenDisplayMode|null  $screenDisplayModeAfterConfirm the screen display mode for M2 after confirmation (optional)
     *
     * @return string the constructed M2 value
     */
    private function createM2Value(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColorAfterConfirm,
        ?LightMode $lightModeAfterConfirm,
        ?ScreenDisplayMode $screenDisplayModeAfterConfirm
    ): string {
        $lightColorAfterConfirm = $lightColorAfterConfirm ?? $lightModule->getDisplayStatusAfterConfirm()->getLightColor();
        $lightModeAfterConfirm = $lightModeAfterConfirm ?? $lightModule->getDisplayStatusAfterConfirm()->getLightMode();
        $screenDisplayModeAfterConfirm = $screenDisplayModeAfterConfirm ?? $lightModule->getDisplayStatusAfterConfirm()->getScreenDisplayMode();

        return $this->createDisplayModeArrayValue($lightColorAfterConfirm, $lightModeAfterConfirm, $screenDisplayModeAfterConfirm);
    }

    /**
     * Builds the M3 value based on the light module's display status after function key or provided parameters.
     *
     * @param MwuLightModuleInterface $lightModule              the light module to retrieve display statuses from
     * @param LightColor|null         $lightColorAfterFn        the light color for M3 after function key (optional)
     * @param LightMode|null          $lightModeAfterFn         the light mode for M3 after function key (optional)
     * @param ScreenDisplayMode|null  $screenDisplayModeAfterFn the screen display mode for M3 after function key (optional)
     *
     * @return string the constructed M3 value
     */
    private function createM3Value(
        MwuLightModuleInterface $lightModule,
        ?LightColor $lightColorAfterFn,
        ?LightMode $lightModeAfterFn,
        ?ScreenDisplayMode $screenDisplayModeAfterFn
    ): string {
        $lightColorAfterFn = $lightColorAfterFn ?? $lightModule->getDisplayStatusAfterFn()->getLightColor();
        $lightModeAfterFn = $lightModeAfterFn ?? $lightModule->getDisplayStatusAfterFn()->getLightMode();
        $screenDisplayModeAfterFn = $screenDisplayModeAfterFn ?? $lightModule->getDisplayStatusAfterFn()->getScreenDisplayMode();

        return $this->createDisplayModeArrayValue($lightColorAfterFn, $lightModeAfterFn, $screenDisplayModeAfterFn);
    }

    private function createMaValue(
        MwuLightModuleInterface $lightModule,
        ?QuantityKeysMode $quantityKeysMode,
    ): string {
        $quantityKeysMode = $quantityKeysMode ?? $lightModule->getQuantityKeys()->getMode();

        return QuantityKeysMode::getBinaryValue($quantityKeysMode);
    }

    /**
     * Builds a value for the command mode array based on light color, light mode, and screen display mode.
     *
     * @param LightColor        $lightColor        the light color to use
     * @param LightMode         $lightMode         the light mode to use
     * @param ScreenDisplayMode $screenDisplayMode the screen display mode to use
     *
     * @return string the binary string representing the command mode array value
     */
    private function createDisplayModeArrayValue(
        LightColor $lightColor,
        LightMode $lightMode,
        ScreenDisplayMode $screenDisplayMode
    ): string {
        // A binary string representing 20 bits
        $modeArrayBinValues = sprintf(
            '%s%012b%04b%04b',
            self::VALUES_STATIC_PREFIX,
            $lightColor->getBinaryValueWithMode($lightMode),
            $screenDisplayMode->getBinaryValue(),
            self::BUZZER_MODE_OFF
        );

        return EncodingConverter::binaryToAscii($modeArrayBinValues);
    }
}
