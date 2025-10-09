<?php

declare(strict_types=1);

namespace App\Account\Domain\Notification;

interface NotificationInterface
{
    public function send(string $emailTo): void;
}