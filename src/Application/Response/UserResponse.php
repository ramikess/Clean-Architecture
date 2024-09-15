<?php

declare(strict_types=1);

namespace App\Application\Command\User;

use App\Domain\Entity\User;

class UserResponse
{
    public function __construct(
        private readonly User $user,
    ) { }

    public function getUser(): User
    {
        return $this->user;
    }
}