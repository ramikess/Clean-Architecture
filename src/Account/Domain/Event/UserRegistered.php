<?php

declare(strict_types=1);

namespace App\Account\Domain\Event;

use App\SharedKernel\Domain\Event\AbstractDomainEvent;

class UserRegistered extends AbstractDomainEvent
{
    public function __construct(
        public readonly string $email
    ) {}

    public function getDescription(): string
    {
        return 'Un utilisateur vient de s\'enregistrer sur le site';
    }

    public function getTagName(): string
    {
        return 'user_regitered';
    }
}
