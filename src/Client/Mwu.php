<?php

declare(strict_types=1);

namespace MwuSdk\Client;

/**
 * This class serves as the main entry point for managing and interacting with MWU light modules and switches.
 * It may provide utility functions, configuration settings, and methods for initiating communication
 * with individual screens or groups of screens.
 */
final class Mwu implements MwuClientInterface
{
    /** @param array<array-key, MwuSwitchInterface> $switches */
    public function __construct(
        private array $switches,
    ) {
    }

    /**
     * @return array<array-key, MwuSwitchInterface>
     */
    public function getSwitches(): array
    {
        return $this->switches;
    }

    public function addSwitch(MwuSwitchInterface $switch): self
    {
        $this->switches[$switch->getUniqueIdentifier()] = $switch;

        return $this;
    }

    public function removeSwitch(MwuSwitchInterface $switch): self
    {
        unset($this->switches[$switch->getUniqueIdentifier()]);

        return $this;
    }
}
