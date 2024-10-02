<?php

declare(strict_types=1);

namespace MwuSdk\Factory\Client;

use MwuSdk\Client\MwuSwitch;
use MwuSdk\Client\TcpIpClient;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfigInterface;
use MwuSdk\Factory\Entity\MessageFactory;
use MwuSdk\Validator\Command\TargetedLightModuleCommandValidatorInterface;
use MwuSdk\Validator\Command\TargetedSwitchCommandValidatorInterface;

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
        private TargetedSwitchCommandValidatorInterface $targetedSwitchCommandValidator,
        private TargetedLightModuleCommandValidatorInterface $targetLightModuleValidator,
    ) {
    }

    public function create(SwitchConfigInterface $config): MwuSwitch
    {
        $switch = new MwuSwitch(
            $config,
            new TcpIpClient(),
            new MessageFactory(),
            $this->targetedSwitchCommandValidator,
            $this->targetLightModuleValidator,
        );

        $this->lightModuleFactory->generateCollection(
            $config->getLightModulesGeneratorConfig(),
            $switch,
        );

        return $switch;
    }

    /**
     * @param array<array-key, SwitchConfigInterface> $configs
     *
     * @return array<array-key, MwuSwitch>
     */
    public function createCollection(array $configs): array
    {
        return array_map(
            [$this, 'create'],
            $configs,
        );
    }
}
