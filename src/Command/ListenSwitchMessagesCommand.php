<?php

declare(strict_types=1);

namespace MwuSdk\Command;

use MwuSdk\Client\ConfigurableMwuServiceInterface;
use MwuSdk\Client\MwuSwitchInterface;
use MwuSdk\Exception\Client\Mwu\SwitchNotFoundException;
use MwuSdk\Exception\Client\TcpIp\CannotConnectSocketException;
use MwuSdk\Exception\Client\TcpIp\CannotCreateSocketException;
use MwuSdk\Exception\Client\TcpIp\SocketClosedException;
use MwuSdk\Exception\Client\TcpIp\SocketReceiveException;
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

        $this->write(
            $output,
            sprintf(
                'Start listening to switch #%s on %s:%s...',
                $this->switchId,
                $switch->getIpAddress(),
                $switch->getPort(),
            ),
        );

        $this->launchListener($switch, $input, $output);

        return Command::SUCCESS;
    }

    private function fetchSwitch(mixed $switchId): MwuSwitchInterface
    {
        if (filter_var($switchId, \FILTER_VALIDATE_INT)) {
            throw new SwitchNotFoundException($switchId);
        }

        $this->switchId = (int) $switchId;

        return $this->mwuService->getSwitchById($this->switchId);
    }

    private function createSocket(MwuSwitchInterface $switch, OutputInterface $output): \Socket
    {
        try {
            $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);

            if (false === $socket) {
                throw new CannotCreateSocketException();
            }

            $ipAddress = $switch->getIpAddress();
            $port = $switch->getPort();

            $connected = socket_connect(
                $socket,
                $ipAddress,
                $port,
            );

            if (false === $connected) {
                throw new CannotConnectSocketException($ipAddress, $port);
            }

            return $socket;
        } catch (\Exception $exception) {
            $this->write($output, $exception->getMessage());
        }

        return $this->createSocket($switch, $output);
    }

    private function launchListener(MwuSwitchInterface $switch, InputInterface $input, OutputInterface $output): void
    {
        $socket = $this->createSocket($switch, $output);

        $receivedData = '';
        $receivedBytes = socket_recv($socket, $receivedData, 1024, 0);

        try {
            if (false === $receivedBytes) {
                throw new SocketReceiveException(socket_strerror(socket_last_error($socket)));
            }
            if (0 === $receivedBytes) {
                throw new SocketClosedException();
            }

            $this->write($output, sprintf('Received message: %s', $receivedData));


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
