<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) { }

    public function saveUser(User $entry): void
    {
        $user = new User();
        $user->setEmail($entry->getEmail());
        $user->setPassword($entry->getPassword());
        $user->setFirstName($entry->getFirstName());
        $user->setLastName($entry->getLastName());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}