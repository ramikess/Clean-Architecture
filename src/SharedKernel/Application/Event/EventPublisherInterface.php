<?php

declare(strict_types=1);

namespace App\SharedKernel\Application\Event;

use App\SharedKernel\Domain\Event\AbstractDomainEvent;

interface EventPublisherInterface
{
    public function publish(AbstractDomainEvent $event, ?int $delayInMs = null): void;
}