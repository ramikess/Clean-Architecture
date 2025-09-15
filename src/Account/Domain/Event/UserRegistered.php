<?php

declare(strict_types=1);

namespace App\Account\Domain\Event;

class UserRegistered
{
    public function __construct(
        public readonly string $email
    ) {}
}
