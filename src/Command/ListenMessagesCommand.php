<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Command;

use Random\RandomException;
use Rossel\MwuSdk\Client\Mwu\ConfigurableMwuServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

#[AsCommand(name: 'mwu:listen', description: 'Listen to MWU and send messages')]
final class ListenMessagesCommand extends Command
{
    public function __construct(
        private readonly ConfigurableMwuServiceInterface $mwuService,
    ) {
        parent::__construct();
    }

    /**
     * Executes the command to listen to MWU switches and launch parallel processes for each.
     *
     * @throws RandomException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->write($output, 'Start listening...');

        // Get the switches from the service
        $switches = $this->mwuService->getSwitches();
        $processes = [];

        // Start a process for each switch
        foreach ($switches as $key => $switch) {
            $this->write($output, sprintf('Listening for switch %d...', $key));

            $process = new Process(['php', 'bin/console', 'mwu:switch:listen', (string) $key]);
            $process->start();

            // Add the process to the list of running processes
            $processes[$key] = $process;
        }

        // Monitor processes concurrently without blocking
        do {
            foreach ($processes as $key => $process) {
                // Read the output from the running process and display it
                if ($process->isRunning()) {
                    // Capture and output real-time stdout
                    $output->write($process->getIncrementalOutput());
                    // Capture and output real-time stderr
                    $output->write($process->getIncrementalErrorOutput());
                    continue;
                }

                // Process has finished, output the result
                if ($process->isSuccessful()) {
                    $output->writeln(sprintf('Switch %d processed successfully', $key));
                } else {
                    $output->writeln(sprintf('<error>Switch %d encountered an error</error>', $key));
                    $output->writeln($process->getErrorOutput());
                }

                // Remove the finished process from the list
                unset($processes[$key]);
            }

            // Add a small sleep to prevent overloading the CPU
            usleep(100000); // 100ms
        } while (!empty($processes));

        $this->write($output, 'All processes completed.');

        return Command::SUCCESS;
    }

    private function write(OutputInterface $output, string $message): void
    {
        $output->writeln(
            sprintf(
                '%s | MWU | %s',
                date('Y-m-d H:i:s'),
                $message,
            ),
        );
    }
}
