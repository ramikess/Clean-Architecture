<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Event;

use App\Account\Application\Event\EventPublisherInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventPublisher implements EventPublisherInterface
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {}

    public function publish(object $event): void
    {
        $this->bus->dispatch($event);
    }
}