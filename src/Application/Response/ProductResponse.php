<?php

declare(strict_types=1);

namespace App\Application\Response;

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