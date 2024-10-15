<?php

declare(strict_types=1);

namespace MwuSdk\Events\Dispatcher;

use MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use MwuSdk\Client\TcpIp\TcpIpClient;
use MwuSdk\Entity\Command\ClientCommand\Ack\AckCommand;
use MwuSdk\Entity\Message\ClientMessage\ClientMessage;
use MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use MwuSdk\Events\Event\EventInterface;
use MwuSdk\Events\Event\MessageReceivedEventInterface;
use MwuSdk\Events\Manager\EventManagerInterface;
use MwuSdk\Factory\Events\Event\MessageReceived\MessageReceivedEventFactoryInterface;
use MwuSdk\Factory\Events\Event\MessageSent\MessageSentEventFactoryInterface;
use Random\RandomException;

final readonly class EventDispatcher implements EventDispatcherInterface
{
    public function __construct(
        private EventManagerInterface $eventManager,
        private MessageSentEventFactoryInterface $messageSentEventFactory,
        private MessageReceivedEventFactoryInterface $messageReceivedEventFactory,
    ) {
    }

    public function dispatchEvent(EventInterface $event): void
    {
        $this->eventManager->handleEvent($event);
    }

    /**
     * @throws RandomException
     */
    public function dispatchMessageReceivedEvent(
        MwuSwitchInterface $switch,
        string $stringMessage,
        \Socket $socket,
    ): void {
        $event = $this->messageReceivedEventFactory->createFromStringMessage($switch, $stringMessage);
        $this->sendAckOnMessageReception($event, $socket);
        $this->dispatchEvent($event);
    }

    public function dispatchMessageSentEvent(
        ClientMessageInterface $message
    ): void {
        $this->dispatchEvent(
            $this->messageSentEventFactory->createFromMessage($message)
        );
    }

    /**
     * @throws RandomException
     */
    private function sendAckOnMessageReception(
        MessageReceivedEventInterface $messageReceivedEvent,
        \Socket $socket,
    ): void {
        $sequenceNumber = $messageReceivedEvent->getMessage()->getSequenceNumber();

        $ackMessage = new ClientMessage(
            new AckCommand(),
            $sequenceNumber,
        );

        TcpIpClient::sendMessageToSocket($socket, (string) $ackMessage);
    }
}
