<?php

declare(strict_types=1);

namespace App\Application\Command\Product;

class SearchProductRequest
{
    public function __construct(
        private readonly int $id
    ) { }

    public function getId(): int
    {
        return $this->id;
    }
}