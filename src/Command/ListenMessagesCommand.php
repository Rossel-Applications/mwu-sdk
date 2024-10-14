<?php

declare(strict_types=1);

namespace MwuSdk\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'mwu:listen', description: 'Listen to mwu send messages')]
final class ListenMessagesCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('start listening');

        return Command::SUCCESS;
    }
}
