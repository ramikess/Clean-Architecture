<?php

declare(strict_types=1);

namespace App\UserInterface\Presenter\User;

use App\Application\DTO\User\UserResponse;
use App\Application\UseCase\Present\UserPresentInterface;

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