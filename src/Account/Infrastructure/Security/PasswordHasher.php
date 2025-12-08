<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Security;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final class PasswordHasher
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    { }

    public function hashPassword(PasswordAuthenticatedUserInterface $user, string $plainPassword): string
    {
        return $this->passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
    }
}