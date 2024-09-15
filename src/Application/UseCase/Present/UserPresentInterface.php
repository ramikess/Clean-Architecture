<?php

declare(strict_types=1);

namespace App\Application\UseCase\Present;

use App\Application\DTO\User\UserResponse;

interface UserPresentInterface
{
    public function present(UserResponse $response): void;
}