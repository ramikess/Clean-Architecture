<?php

declare(strict_types=1);

namespace App\Application\MessageHandler;

use App\Application\MessageBus\SendUserWelcomeEmailMessage;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class SendUserWelcomeEmailMessageHandler
{
    public function __construct(
        private MailerInterface $mailer,
        private UserRepositoryInterface $userRepository
    ) {}

    public function __invoke(SendUserWelcomeEmailMessage $message)
    {
        $user = $this->userRepository->find($message->getUserId());

        if (!$user) {
            // Gérer le cas où l'utilisateur n'est pas trouvé
            return;
        }

        $email = (new Email())
            ->from('noreply@yourapp.com')
            ->to('rami@pourdebon.com')
            ->subject('Bienvenue sur notre site')
            ->text(sprintf('Bonjour %s, merci pour votre inscription.', $user->getFirstName()));

        $this->mailer->send($email);
    }
}