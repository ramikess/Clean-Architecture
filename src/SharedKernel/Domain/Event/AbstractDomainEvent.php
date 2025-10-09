<?php

declare(strict_types=1);

namespace App\SharedKernel\Domain\Event;

abstract class AbstractDomainEvent
{
    abstract public function getDescription(): string;
    abstract public function getTagName(): string;

}