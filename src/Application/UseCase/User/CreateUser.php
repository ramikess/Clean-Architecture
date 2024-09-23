<?php

declare(strict_types=1);

namespace App\Application\UseCase\User;

use App\Application\Command\User\CreateUserRequest;
use App\Application\Command\User\UserResponse;
use App\Application\MessageBus\SendUserWelcomeEmailMessage;
use App\Application\Present\UserPresentInterface;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class CreateUser
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private MessageBusInterface $bus
    ) { }

    public function execute(CreateUserRequest $request, UserPresentInterface $present): void
    {
        $user = new User();
        $user->setEmail($request->getEmail());
        $user->setPassword($request->getPassword());
        $user->setFirstName($request->getFirstName());
        $user->setLastName($request->getLastName());

        $user = $this->userRepository->saveUser($user);


        // Dispatcher le message pour l'envoi de l'e-mail asynchrone
        $this->bus->dispatch(new SendUserWelcomeEmailMessage($user->getId()));

        $present->present(new UserResponse($user));
    }
}