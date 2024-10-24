<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Factory\Client;

use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitch;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfigInterface;
use Rossel\MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use Rossel\MwuSdk\Factory\Entity\Message\ClientMessage\ClientMessageFactory;
use Rossel\MwuSdk\Validator\Command\TargetedLightModuleCommandValidatorInterface;
use Rossel\MwuSdk\Validator\Command\TargetedSwitchCommandValidatorInterface;

/**
 * Factory class for creating MwuSwitch instances.
 *
 * This class constructs MwuSwitch objects based on configuration and manages the
 * generation of associated light modules.
 */
final readonly class MwuSwitchFactory implements MwuSwitchFactoryInterface
{
    public function __construct(
        private MwuLightModuleFactory $lightModuleFactory,
        private ClientMessageFactory $messageFactory,
        private TargetedSwitchCommandValidatorInterface $targetedSwitchCommandValidator,
        private TargetedLightModuleCommandValidatorInterface $targetLightModuleValidator,
    ) {
    }

    public function create(SwitchConfigInterface $config, ?BehaviorConfigInterface $behaviorConfig = null): MwuSwitch
    {
        return new MwuSwitch(
            $config,
            $behaviorConfig,
            $this->messageFactory,
            $this->lightModuleFactory,
            $this->targetedSwitchCommandValidator,
            $this->targetLightModuleValidator,
        );
    }

    /**
     * @param array<array-key, SwitchConfigInterface> $switchConfigs
     *
     * @return array<array-key, MwuSwitch>
     */
    public function createCollection(array $switchConfigs, ?BehaviorConfigInterface $behaviorConfig): array
    {
        $results = [];

        foreach ($switchConfigs as $switchConfig) {
            $results[] = $this->create($switchConfig, $behaviorConfig);
        }

        return $results;
    }
}
