<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product\Update;

class UpdateProductPriceRequest
{
    public function __construct(
        private readonly int $id,
        private readonly int $newPrice,
    ) { }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNewPrice(): int
    {
        return $this->newPrice;
    }
}
