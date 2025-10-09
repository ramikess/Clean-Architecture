<?php

declare(strict_types=1);

namespace App\SharedKernel\Infrastructure\EventBus;

use App\SharedKernel\Application\Event\EventPublisherInterface;
use App\SharedKernel\Domain\Event\AbstractDomainEvent;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Zenstruck\Messenger\Monitor\Stamp\DescriptionStamp;
use Zenstruck\Messenger\Monitor\Stamp\TagStamp;

class MessengerEventPublisher implements EventPublisherInterface
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {}

    public function publish(AbstractDomainEvent $event, ?int $delayInMs = null): void
    {
        $stamps = [
            new TagStamp($event->getTagName()),
            new DescriptionStamp($event->getDescription())
        ];

        if ($delayInMs !== null) {
            $stamps[] = new DelayStamp($delayInMs);
        }

        $this->bus->dispatch(
            $event,
            $stamps
        );
    }
}