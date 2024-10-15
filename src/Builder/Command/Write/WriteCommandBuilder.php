<?php

declare(strict_types=1);

namespace MwuSdk\Builder\Command\Write;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Entity\Command\ClientCommand\Write\WriteCommand;
use MwuSdk\Entity\Command\ClientCommand\Write\WriteCommandInterface;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use MwuSdk\Exception\Builder\LightModuleTextMaxLengthExceededException;
use MwuSdk\Exception\Client\LightModule\UnreachableLightModuleException;
use MwuSdk\Factory\Dto\Command\Write\WriteCommandModeArrayFactoryInterface;

/**
 * Builder for write commands.
 */
final class WriteCommandBuilder implements WriteCommandBuilderInterface
{
    private const MWU_COMMAND = 'PP5';
    private const MWU_COMMAND_OPTION_FN_VALUE_SPECIFIED = [
        true => '05',
        false => '00',
    ];

    private ?string $fnData = null;
    private ?LightColor $lightColor = null;
    private ?LightMode $lightMode = null;
    private ?ScreenDisplayMode $screenDisplayMode = null;

    public function __construct(
        private readonly WriteCommandModeArrayFactoryInterface $modeArrayFactory,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function withFnData(?string $data): self
    {
        $this->fnData = $data;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function withLightColor(?LightColor $color): self
    {
        $this->lightColor = $color;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function withLightMode(?LightMode $mode): self
    {
        $this->lightMode = $mode;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function withScreenDisplayMode(?ScreenDisplayMode $screenDisplayMode): self
    {
        $this->screenDisplayMode = $screenDisplayMode;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFnData(): ?string
    {
        return $this->fnData;
    }

    /**
     * {@inheritDoc}
     */
    public function getLightColor(): ?LightColor
    {
        return $this->lightColor;
    }

    /**
     * {@inheritDoc}
     */
    public function getLightMode(): ?LightMode
    {
        return $this->lightMode;
    }

    /**
     * {@inheritDoc}
     */
    public function getScreenDisplayMode(): ?ScreenDisplayMode
    {
        return $this->screenDisplayMode;
    }

    /**
     * {@inheritDoc}
     *
     * @throws UnreachableLightModuleException
     */
    public function buildCommand(MwuLightModuleInterface $lightModule, ?string $text = null): WriteCommand
    {
        $lightModule->checkIfReachable(true);

        $text = $text ?? $lightModule->getDisplayStatus()->getDefaultText();
        $textMaxLength = $lightModule->getTextMaxLength();

        if (\strlen($text) > $textMaxLength) {
            throw new LightModuleTextMaxLengthExceededException($lightModule, $text);
        }

        $template = $this->getCommandTemplate($lightModule);

        return new WriteCommand($lightModule, sprintf($template, $text));
    }

    /**
     * {@inheritDoc}
     *
     * @return array<int, WriteCommandInterface>
     */
    public function buildCommands(array $lightModules, ?string $text = null, array &$errors = []): array
    {
        $commands = [];

        foreach ($lightModules as $lightModule) {
            try {
                /** @var int $lightModuleId */
                $lightModuleId = $lightModule->getId();

                $command = $this->buildCommand($lightModule, $text);

                $commands[$lightModuleId] = $command;
            } catch (UnreachableLightModuleException $exception) {
                $errors[] = $exception;
            }
        }

        return $commands;
    }

    /**
     * Generates a command template for the specified light module.
     * It will contain one '%s' characters groups, for the text to display.
     *
     * This method constructs a command template string based on the provided light module's
     * configuration and the configuration of the builder object.
     *
     * <b>Usage:</b>
     * <code>
     *     $builder = new WriteCommandBuilder($modeArrayFactory);
     *     $textToDisplay = '00P1';
     *
     *     // a string containing one '%s' characters groups, for the text to display
     *     $template = $builder->getCommandTemplate($lightModule);
     *
     *     // usage:
     *     $executableCommand = sprintf($template, $textToDisplay);
     * </code>
     *
     * @param MwuLightModuleInterface $lightModule The light module to which the command will be sent.
     *                                             This parameter is required to fetch the configuration
     *                                             of the light module.
     *
     * @return string the formatted command template for the light module, including
     *                the specified modes and values
     */
    private function getCommandTemplate(MwuLightModuleInterface $lightModule): string
    {
        $staticPrefix = self::MWU_COMMAND.'05';
        $fnDataSpecified = null !== $this->fnData;
        $blockNumber = '00';

        $modeArray = $this->modeArrayFactory->create(
            $lightModule,
            $this->getLightColor(),
            $this->getLightMode(),
            $this->getScreenDisplayMode(),
        );

        return sprintf(
            '%s%s%s%s%04s%% 5s%s',
            $staticPrefix,
            self::MWU_COMMAND_OPTION_FN_VALUE_SPECIFIED[$fnDataSpecified],
            $blockNumber,
            $modeArray,
            $lightModule->getId(),
            $fnDataSpecified ? sprintf('% 5s', $this->getFnData()) : '',
        );
    }
}
