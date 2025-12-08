<?php

declare(strict_types=1);

namespace App\Account\Application\UseCase;

use App\Account\Application\Exception\EmailAlreadyUsedException;
use App\Account\Domain\Aggregate\User;
use App\Account\Domain\Event\UserRegistered;
use App\Account\Domain\Repository\UserRepositoryContract;
use App\Account\Infrastructure\Security\PasswordHasher;
use App\Account\Infrastructure\Security\PasswordUserAdapter;
use App\SharedKernel\Application\Event\EventPublisherInterface;

class RegisterUserUseCase
{
    public function __construct(
        private readonly PasswordHasher          $passwordHasher,
        private readonly EventPublisherInterface $eventPublisher,
        private readonly UserRepositoryContract  $userRepository
    ) {}

    /**
     * @throws EmailAlreadyUsedException
     */
    public function __invoke(string $email, string $plainPassword): void
    {
        if ($this->userRepository->findByEmail($email)) {
            throw new EmailAlreadyUsedException();
        }

        $user = new User();
        $user->setEmail($email);

        $userAdapter = new PasswordUserAdapter($user);
        $hashedPassword = $this->passwordHasher->hashPassword($userAdapter, $plainPassword);
        $user->setPassword($hashedPassword);

        $this->userRepository->save($user);

        $delayInMs = 5 * 60 * 1000;
        $this->eventPublisher->publish(new UserRegistered(
            $user->getEmail()
        ), $delayInMs);
    }
}