<?php

declare(strict_types=1);

namespace MwuSdk\Command;

use MwuSdk\Client\Mwu\ConfigurableMwuServiceInterface;
use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Client\TcpIp\TcpIpClient;
use MwuSdk\Events\Dispatcher\EventDispatcherInterface;
use MwuSdk\Exception\Client\Mwu\SwitchNotFoundException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'mwu:switch:listen',
    description: 'Listen to mwu send messages on a specific switch',
    aliases: ['mwu:listen-switch'],
)]
final class ListenSwitchMessagesCommand extends Command
{
    private const ARGUMENT_SWITCH_ID = 'switch-id';

    private int $switchId;

    public function __construct(
        private readonly ConfigurableMwuServiceInterface $mwuService,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument(self::ARGUMENT_SWITCH_ID, InputArgument::REQUIRED, 'Identifier of the switch.');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $switchId = $input->getArgument(self::ARGUMENT_SWITCH_ID);
        $switch = $this->fetchSwitch($switchId);

        $this->launchListener($switch, $input, $output);

        return Command::SUCCESS;
    }

    private function fetchSwitch(mixed $switchId): MwuSwitchInterface
    {
        if (false === is_numeric($switchId)) {
            throw new SwitchNotFoundException($switchId);
        }

        // Cast to int after validation
        $this->switchId = (int) $switchId;

        return $this->mwuService->getSwitchById($this->switchId);
    }

    private function createSocket(MwuSwitchInterface $switch, OutputInterface $output): \Socket
    {
        try {
            return TcpIpClient::createSocket($switch->getIpAddress(), $switch->getPort());
        } catch (\Exception $exception) {
            $this->write($output, $exception->getMessage());
        }

        sleep(1);

        return $this->createSocket($switch, $output);
    }

    private function launchListener(MwuSwitchInterface $switch, InputInterface $input, OutputInterface $output): void
    {
        $socket = $this->createSocket($switch, $output);

        $this->write(
            $output,
            sprintf(
                'Start listening to switch #%s on %s:%s...',
                $this->switchId,
                $switch->getIpAddress(),
                $switch->getPort(),
            ),
        );

        try {
            $receivedStringMessage = TcpIpClient::receiveMessageFromSocket($socket);
            $this->write($output, sprintf('Received message: %s', $receivedStringMessage));
            $this->eventDispatcher->dispatchMessageReceivedEvent($switch, $receivedStringMessage, $socket);
        } catch (\Exception $exception) {
            $this->write($output, $exception->getMessage());
        } finally {
            $this->launchListener($switch, $input, $output);
        }
    }

    private function write(OutputInterface $output, string $message): void
    {
        $output->writeln(
            sprintf(
                'Switch #%s | %s',
                $this->switchId,
                $message,
            ),
        );
    }
}
