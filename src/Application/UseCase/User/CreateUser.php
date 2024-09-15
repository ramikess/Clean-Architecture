<?php

declare(strict_types=1);

namespace App\Application\UseCase\User;

use App\Application\Command\User\CreateUserRequest;
use App\Application\Command\User\UserResponse;
use App\Application\Present\UserPresentInterface;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class CreateUser
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private PasswordHasherInterface $passwordHasher
    ) { }

    public function execute(CreateUserRequest $request, UserPresentInterface $present): void
    {
        $user = new User();
        $user->setEmail($request->getEmail());
        $user->setPassword($this->passwordHasher->hash($request->getPassword()));
        $user->setFirstName($request->getFirstName());
        $user->setLastName($request->getLastName());

        $this->userRepository->saveUser($user);

        $present->present(new UserResponse($user));
    }
}