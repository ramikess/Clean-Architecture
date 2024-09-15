<?php

declare(strict_types=1);

namespace App\Application\Present;

use App\Application\Command\User\UserResponse;

interface UserPresentInterface
{
    public function present(UserResponse $response): void;
}