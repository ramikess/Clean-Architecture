<?php

declare(strict_types=1);

namespace App\Account\Application\Event;

interface EventPublisherInterface
{
    public function publish(object $event): void;
}