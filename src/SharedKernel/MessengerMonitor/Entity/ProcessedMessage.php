<?php

namespace App\SharedKernel\MessengerMonitor\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zenstruck\Messenger\Monitor\History\Model\ProcessedMessage as BaseProcessedMessage;

#[ORM\Entity(readOnly: true)]
#[ORM\Table('messenger_processed_messages')]
class ProcessedMessage extends BaseProcessedMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function id(): ?int
    {
        return $this->id;
    }
}
