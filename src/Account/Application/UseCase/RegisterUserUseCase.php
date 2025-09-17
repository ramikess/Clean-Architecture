<?php

declare(strict_types=1);

namespace App\Account\Application\UseCase;

use App\Account\Application\Event\EventPublisherInterface;
use App\Account\Domain\Aggregate\User;
use App\Account\Domain\Event\UserRegistered;
use App\Account\Domain\Repository\UserRepositoryContract;
use App\Account\Infrastructure\Security\PasswordHasher;
use App\Account\Infrastructure\Security\PasswordUserAdapter;
use Doctrine\ORM\EntityManagerInterface;

class RegisterUserUseCase
{
    public function __construct(
        private readonly PasswordHasher          $passwordHasher,
        private readonly EventPublisherInterface $eventPublisher,
        private readonly UserRepositoryContract  $userRepository
    ) {}

    public function __invoke(string $email, string $plainPassword): void
    {
        $user = new User();
        $user->setEmail($email);

        $userAdapter = new PasswordUserAdapter($user);
        $hashedPassword = $this->passwordHasher->hashPassword($userAdapter, $plainPassword);
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user);

        $this->eventPublisher->publish(new UserRegistered(
            $user->getEmail()
        ));
    }
}