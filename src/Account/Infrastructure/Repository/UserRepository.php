<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Repository;

use App\Account\Domain\Aggregate\User;
use App\Account\Domain\Repository\UserRepositoryContract;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryContract
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}