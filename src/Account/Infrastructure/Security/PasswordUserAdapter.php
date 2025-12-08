<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Security;

use App\Account\Domain\Aggregate\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class PasswordUserAdapter implements UserInterface, PasswordAuthenticatedUserInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // ===== PasswordAuthenticatedUserInterface =====
    public function getPassword(): string
    {
        return $this->user->getPassword();
    }

    // ===== UserInterface =====
    public function getUserIdentifier(): string
    {
        return $this->user->getEmail();
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        return;
    }

    public function getUserId(): int
    {
        return $this->user->getId();
    }
}