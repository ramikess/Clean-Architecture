<?php

namespace App\Account\Infrastructure\Mailer;

use App\Account\Domain\Notification\NotificationInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendMailService implements NotificationInterface
{

    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function send(string $emailTo): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($emailTo)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html("<p>Hello $emailTo!</p>");

        $this->mailer->send($email);
    }
}