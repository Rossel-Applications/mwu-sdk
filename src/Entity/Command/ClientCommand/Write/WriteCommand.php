<?php

declare(strict_types=1);

namespace MwuSdk\Entity\Command\ClientCommand\Write;

use MwuSdk\Client\MwuLightModule\MwuLightModuleInterface;
use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Entity\Command\AbstractCommand;
use MwuSdk\Exception\Client\LightModule\UnreachableLightModuleException;

/**
 * Represents a write command for the MWU Light Module.
 *
 * This command contains configuration and data to send to the MWU Light Module, allowing control over display options such as text to display, light color, and button behavior.
 */
final readonly class WriteCommand extends AbstractCommand implements WriteCommandInterface
{
    public function __construct(
        private MwuLightModuleInterface $lightModule,
        string $commandTemplate,
    ) {
        parent::__construct($commandTemplate);
    }

    public function getLightModule(): MwuLightModuleInterface
    {
        return $this->lightModule;
    }

    public function getSwitch(): MwuSwitchInterface
    {
        $lightModule = $this->getLightModule();
        $lightModule->checkIfReachable(true);

        $switch = $this->getLightModule()->getSwitch();

        if (null === $switch) {
            throw new UnreachableLightModuleException($lightModule, UnreachableLightModuleException::DETAILS_MISSING_SWITCH);
        }

        return $switch;
    }
}
