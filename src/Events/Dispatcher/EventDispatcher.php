<?php

declare(strict_types=1);

namespace Rossel\MwuSdk\Events\Dispatcher;

use Random\RandomException;
use Rossel\MwuSdk\Client\MwuSwitch\MwuSwitchInterface;
use Rossel\MwuSdk\Client\TcpIp\TcpIpClient;
use Rossel\MwuSdk\Entity\Command\ClientCommand\Ack\AckCommand;
use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessage;
use Rossel\MwuSdk\Entity\Message\ClientMessage\ClientMessageInterface;
use Rossel\MwuSdk\Events\Event\EventInterface;
use Rossel\MwuSdk\Events\Event\MessageReceivedEventInterface;
use Rossel\MwuSdk\Events\Manager\EventManagerInterface;
use Rossel\MwuSdk\Factory\Events\Event\MessageReceived\MessageReceivedEventFactoryInterface;
use Rossel\MwuSdk\Factory\Events\Event\MessageSent\MessageSentEventFactoryInterface;

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
