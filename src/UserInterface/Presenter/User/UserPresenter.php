<?php

declare(strict_types=1);

namespace App\UserInterface\Presenter\User;

use App\Application\Command\User\UserResponse;
use App\Application\Present\UserPresentInterface;

class UserPresenter implements UserPresentInterface
{
    private UserResponse $response;

    public function present(UserResponse $response): void
    {
        $this->response = $response;
    }

    public function getViewModel(): UserResponse
    {
        return $this->response;
    }
}