<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function saveUser(User $entry): User;
    public function find(int $userId): User;
}