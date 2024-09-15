<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function saveProduct(Product $entry): void;
    public function searchProduct(int $id): Product;
    public function flush(): void;
}