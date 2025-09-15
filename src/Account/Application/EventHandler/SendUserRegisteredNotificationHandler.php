<?php

declare(strict_types=1);

namespace App\Account\Application\EventHandler;

use App\Account\Domain\Event\UserRegistered;
use App\Account\Domain\Notification\NotificationInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SendUserRegisteredNotificationHandler
{
    public function __construct(
        private readonly NotificationInterface $notification
    ) {}

    public function __invoke(UserRegistered $event): void
    {
        $this->notification->send();
    }
}