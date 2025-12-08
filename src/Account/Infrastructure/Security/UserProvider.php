<?php

declare(strict_types=1);

namespace App\Account\Infrastructure\Security;

use App\Account\Domain\Aggregate\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['email' => $identifier]);

        if (!$user) {
            throw new UserNotFoundException(sprintf('User "%s" not found.', $identifier));
        }

        return new PasswordUserAdapter($user);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof PasswordUserAdapter) {
            throw new \InvalidArgumentException('Unsupported user type.');
        }

        $domainUser = $this->em->getRepository(User::class)->find($user->getUserId());

        if (!$domainUser) {
            throw new UserNotFoundException('User not found.');
        }

        return new PasswordUserAdapter($domainUser);
    }

    public function supportsClass(string $class): bool
    {
        return $class === PasswordUserAdapter::class;
    }
}
