<?php

declare(strict_types=1);

namespace MwuSdk\Command;

use MwuSdk\Client\Mwu\ConfigurableMwuServiceInterface;
use MwuSdk\Entity\Command\ClientCommand\Ack\AckCommand;
use MwuSdk\Entity\Message\ClientMessage\ClientMessage;
use Random\RandomException;
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

    /**
     * @throws RandomException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Start listening...');

        $switches = $this->mwuService->getSwitches();
        $sockets = [];

        foreach ($switches as $key => $switch) {
            $output->writeln(sprintf('Start listening to %s:%s...', $switch->getIpAddress(), $switch->getPort()));
            $socket = socket_create(\AF_INET, \SOCK_STREAM, \SOL_TCP);
            $connected = socket_connect($socket, $switch->getIpAddress(), $switch->getPort());

            if (true === $connected) {
                $sockets[$key] = $socket;
            }
        }

        set_time_limit(0);

        $socket = $sockets[0];

        while (true) {
            $buffer = '';  // Variable pour stocker les données reçues
            $bytes_received = socket_recv($socket, $buffer, 1024, 0); // Receive up to 1024 octets

            if (false === $bytes_received) {
                echo 'Erreur lors de la réception de données : '.socket_strerror(socket_last_error($socket))."\n";
                break;  // Sortir de la boucle en cas d'erreur
            }
            if (0 === $bytes_received) {
                echo "Le serveur a fermé la connexion.\n";
                break;  // Sortir de la boucle si la connexion est fermée
            }

            // Afficher le message reçu
            echo "Message reçu : $buffer\n";

            $command = $buffer;
            $seqNumber = substr($command, 1, 3);

            $response = (string) new ClientMessage(new AckCommand(), $seqNumber);
            socket_write($socket, $response);
            echo "Responded: $response";

            // Condition d'arrêt (optionnelle)
            if ('exit' === trim($buffer)) {
                echo "Fin de la connexion demandée par le serveur.\n";
                break;  // Sortir de la boucle si un message spécifique est reçu
            }
        }

        // Fermer le socket après la boucle
        socket_close($socket);

        return Command::SUCCESS;
    }
}
