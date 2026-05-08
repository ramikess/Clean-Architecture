<?php

namespace App\Catalog\Domain\Repository;

use App\Catalog\Domain\Aggregate\Product;

interface ProductRepositoryInterface
{
    public function findByExternalIds(array $externalIds): array;
    public function save(Product $product): void;
    public function flush(): void;
}