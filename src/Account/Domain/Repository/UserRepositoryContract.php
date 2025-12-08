<?php

declare(strict_types=1);

namespace App\Account\Domain\Repository;

use App\Account\Domain\Aggregate\User;

interface UserRepositoryContract
{
    public function save(User $user): void;
    public function findByEmail(string $email): ?User;
}