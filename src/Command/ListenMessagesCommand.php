<?php

declare(strict_types=1);

namespace MwuSdk\Command;

use MwuSdk\Client\ConfigurableMwuServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'mwu:listen', description: 'Listen to mwu send messages')]
final class ListenMessagesCommand extends Command
{
    public function __construct(
        private readonly ConfigurableMwuServiceInterface $mwuService,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Start listening...');

        $switches = $this->mwuService->getSwitches();
        $sockets = [];

        foreach ($switches as $switch) {
            $output->writeln(sprintf('Start listening to %s:%s...', $switch->getIpAddress(), $switch->getPort()));
            $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);
            $sockets[] = $socket;
            socket_bind($socket, $switch->getIpAddress(), $switch->getPort());
            socket_listen($socket);
        }

        set_time_limit(0);

        while (true) {
            foreach ($sockets as $socket) {
                socket_accept($socket);
                $input .= socket_read($socket, 1024);
                $output->writeln($input);
            }
        }
    }
}
