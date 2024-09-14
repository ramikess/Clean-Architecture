<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Entity\Product;

class ProductResponse
{
    public function __construct(
        private readonly Product $product
    ) { }

    public function getProduct(): Product
    {
        return $this->product;
    }
}