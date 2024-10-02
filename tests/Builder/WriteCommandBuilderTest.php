<?php

declare(strict_types=1);

namespace MwuSdkTest\Builder;

use MwuSdk\Builder\Command\Write\WriteCommandBuilder;
use MwuSdk\Client\MwuLightModule;
use MwuSdk\Client\MwuSwitch;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Client\TcpIpClient;
use MwuSdk\Dto\Client\DefaultConfiguration\Behavior\BehaviorConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\LightModulesGeneratorConfig;
use MwuSdk\Dto\Client\DefaultConfiguration\Infrastructure\SwitchConfig;
use MwuSdk\Entity\Command\Initialize\InitializeCommand;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightColor;
use MwuSdk\Enum\ConfigurationParameterValues\Display\LightMode;
use MwuSdk\Enum\ConfigurationParameterValues\Display\ScreenDisplayMode;
use MwuSdk\Exception\Client\TcpIp\TcpIpClientExceptionInterface;
use MwuSdk\Factory\Client\MwuLightModuleFactory;
use MwuSdk\Factory\Dto\Command\Write\WriteCommandModeArrayFactory;
use MwuSdk\Factory\Entity\MessageFactory;
use MwuSdk\Validator\Command\TargetedLightModuleCommandValidator;
use MwuSdk\Validator\Command\TargetedSwitchCommandValidator;
use MwuSdkTest\Utils\InfrastructureGenerator;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Random\RandomException;

class WriteCommandBuilderTest extends TestCase
{
    private MwuSwitchInterface $mwuSwitch;

    /**
     * @throws RandomException
     */
    protected function setUp(): void
    {
        $this->mwuSwitch = InfrastructureGenerator::generateMwuSwitch();
    }

    /**
     * @throws RandomException
     * @throws Exception
     * @throws TcpIpClientExceptionInterface
     */
    public function testBuildCommand(): void
    {
        // todo: work in progress
        $writeCommandBuilder = new WriteCommandBuilder(new WriteCommandModeArrayFactory());

        // todo: doesnt work without withScreenDisplayMode()
        $writeCommandBuilder->withLightColor(LightColor::GREEN)->withLightMode(LightMode::ON)->withScreenDisplayMode(ScreenDisplayMode::ON);
        $lightModuleId = array_keys($this->mwuSwitch->getLightModules())[0];

        $lm = $this->createMock(MwuLightModule::class);
        $lm->method('getId')->willReturn(1);

        $switch = new MwuSwitch(
            new SwitchConfig('144.56.46.30', 5003, new LightModulesGeneratorConfig(1, 4, 1)),
            new BehaviorConfig(),
            new TcpIpClient(),
            new MessageFactory(),
            new MwuLightModuleFactory(),
            new TargetedSwitchCommandValidator(),
            new TargetedLightModuleCommandValidator(new TargetedSwitchCommandValidator()),
        );

        $lm->method('getSwitch')->willReturn($switch);

        $errors = [];

        $responses = $switch->broadcastWrite($writeCommandBuilder, '0002', $errors);

        foreach ($switch->getLightModules() as $lightModule) {
            // $lightModule->write($writeCommandBuilder, str_pad((string) $lightModule->getId(), 4, ' '));
        }

        // $switch->send(new InitializeCommand());
        // $command = $writeCommandBuilder->buildCommand($lm, '000A');
        // $response = $switch->send($command);
    }
}
