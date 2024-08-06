<?php

declare(strict_types=1);

namespace MwuSdk\Dto\Client\DefaultConfiguration;

use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;

final readonly class MwuConfig implements MwuConfigInterface
{
    /** @var list<SwitchConfigInterface> */
    private array $switches;

    private BehaviorConfigInterface $behavior;

    /**
     * @param list<SwitchConfigInterface> $switches
     */
    public function __construct(
        array $switches,
        BehaviorConfigInterface $behaviorConfig,
    ) {
        $this->switches = $switches;
        $this->behavior = $behaviorConfig;
    }

    /**
     * @return list<SwitchConfigInterface>
     */
    public function getSwitches(): array
    {
        return $this->switches;
    }

    public function getBehavior(): BehaviorConfigInterface
    {
        return $this->behavior;
    }
}
